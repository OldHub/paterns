<?php

namespace Modules\Parser\Handlers;

use Exception;
use Modules\Parser\Constants\ParserConstant;
use Modules\Parser\Handlers\Core\AbstractHandler;
use Modules\Parser\Services\ParserLog\ParserLogService;
use Modules\Parser\Services\ParseCategoriesService;

class ParseCategoriesHandler extends AbstractHandler
{
    private ParseCategoriesService $parseCategoriesService;
    private ParserLogService $logService;
    private string $event;

    public function __construct()
    {
        $this->parseCategoriesService = app(ParseCategoriesService::class);
        $this->event = ParserConstant::EVENT_PARSE_CATEGORIES;
        $this->logService = app(ParserLogService::class);
    }

    /**
     * @throws Exception
     */
    public function handle(bool $next, string $site, string $metro): ?string
    {
        if ($next) {
            try {
                $this->parseCategoriesService->parseCategories($site);
            } catch (Exception $exception) {
                $this->logService->error($this->event, $exception->getMessage());
                $next = false;
            }
        }

        return parent::handle($next, $site, $metro);
    }
}
