<?php

namespace Modules\Parser\Handlers;

use Exception;
use Modules\Parser\Constants\ParserConstant;
use Modules\Parser\Handlers\Core\AbstractHandler;
use Modules\Parser\Services\ParserLog\ParserLogService;
use Modules\Parser\Services\ParseMetrosService;

class ParseMetrosHandler extends AbstractHandler
{
    private ParseMetrosService $parseMetrosService;
    private ParserLogService $logService;
    private string $event;

    public function __construct()
    {
        $this->parseMetrosService = app(ParseMetrosService::class);
        $this->event = ParserConstant::EVENT_PARSE_METROS;
        $this->logService = app(ParserLogService::class);
    }

    /**
     * @throws Exception
     */
    public function handle(bool $next, string $site, string $metro): ?string
    {
        if ($next) {
            try {
                $this->parseMetrosService->parseMetros($metro);
            } catch (Exception $exception) {
                $this->logService->error($this->event, $exception->getMessage());
                $next = false;
            }
        }

        return parent::handle($next, $site, $metro);
    }
}
