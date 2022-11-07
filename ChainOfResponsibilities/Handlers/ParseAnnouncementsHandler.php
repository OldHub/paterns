<?php

namespace Modules\Parser\Handlers;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Modules\Parser\Constants\ParserConstant;
use Modules\Parser\Handlers\Core\AbstractHandler;
use Modules\Parser\Services\ParseAnnouncementsService;
use Modules\Parser\Services\ParserLog\ParserLogService;

class ParseAnnouncementsHandler extends AbstractHandler
{
    private ParserLogService $logService;
    private ParseAnnouncementsService $announcementService;
    private string $event;

    public function __construct()
    {
        $this->announcementService = app(ParseAnnouncementsService::class);
        $this->event = ParserConstant::EVENT_PARSE_ANNOUNCEMENTS;
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
                $this->announcementService->parseAnnouncements($site);
            } catch (Exception $exception) {
                $this->logService->error($this->event, $exception->getMessage());
                $next = false;
            }
        }

        return parent::handle($next, $site, $metro);
    }
}
