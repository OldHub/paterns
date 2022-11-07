<?php

namespace Modules\Parser\Services;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Modules\Parser\Handlers\ConnectHandler;
use Modules\Parser\Handlers\ParseAnnouncementsHandler;
use Modules\Parser\Handlers\ParseCategoriesHandler;
use Modules\Parser\Handlers\ParseMetrosHandler;

class ParserService
{
    /**
     * @throws Exception
     * @throws GuzzleException
     */
    public function startParser(): void
    {
        $announcementsHandler = new ParseAnnouncementsHandler();
        $categoriesHandler = new ParseCategoriesHandler();
        $metrosHandler = new ParseMetrosHandler();
        $connectHandler = new ConnectHandler();

        $connectHandler
            ->setNext($categoriesHandler)
            ->setNext($metrosHandler)
            ->setNext($announcementsHandler);

        $connectHandler->handle(true, '', '');
    }
}
