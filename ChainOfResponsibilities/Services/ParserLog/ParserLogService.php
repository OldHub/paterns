<?php

namespace Modules\Parser\Services\ParserLog;


use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Parser\Factories\ParserLog\LogFactory;
use Modules\Parser\Models\ParserLog;
use Modules\Parser\Repositories\ParserLog\LogRepository;
use Modules\Parser\Validation\ParserLog\RulesValidation\ParserLogValidation;

class ParserLogService
{
    private LogFactory $factory;
    private LogRepository $repository;

    public function __construct(
        LogFactory $factory,
        LogRepository $repository
    )
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @throws Exception
     */
    private function create(string $event, string $message): void
    {
        $parserLog = $this->factory->create();
        $this->populate($parserLog, $event, $message);
        ParserLogValidation::validateStatic($parserLog);
        $this->repository->save($parserLog);
    }

    private function populate(ParserLog $parserLog, string $event, string $message): void
    {
        $parserLog->message = $message;
        $parserLog->event = $event;
    }

    /**
     * @throws Exception
     */
    public function error(string $modelName, string $debug): void
    {
        Log::alert($modelName . ' not completed');
        Log::debug($debug);
        $this->create($modelName, $debug);
    }
}
