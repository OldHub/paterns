<?php

namespace Modules\Parser\Handlers;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Modules\Parser\Constants\ParserConstant;
use Modules\Parser\Handlers\Core\AbstractHandler;
use Modules\Parser\Services\ConnectionService;
use Modules\Parser\Services\ParserLog\ParserLogService;

class ConnectHandler extends AbstractHandler
{
    private ParserLogService $logService;
    private ConnectionService $connectionService;

    public function __construct()
    {
        $this->connectionService = app(ConnectionService::class);
        $this->logService = app(ParserLogService::class);
    }

    /**
     * @throws Exception
     * @throws GuzzleException
     */
    public function handle(bool $next, string $site, string $metro): ?string
    {
        if ($next) {
            try {
                $site = $this->connectionService->getContent(config('parser.siteLink'));
                $metro = $this->connectionService->getContent(config('parser.metroLink'));
            } catch (Exception $exception) {
                $next = false;
                $this->logService->error(ParserConstant::EVENT_NO_CONNECTION, $exception->getMessage());
            }
        }

        return parent::handle($next, $site, $metro);
    }
}
