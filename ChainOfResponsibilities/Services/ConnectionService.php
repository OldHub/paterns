<?php

namespace Modules\Parser\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionService
{
    /**
     * @throws GuzzleException
     */
    public function getContent($link): string
    {
        $client = new Client();

        $response = $client->get($link);

        return $response->getBody()->getContents();
    }
}
