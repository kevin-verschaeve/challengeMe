<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;

class Endomondo implements ApplicationConnectorInterface
{
    const APPLICATION_NAME = 'endomondo';

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function login()
    {
        return '/login';
    }

    public function logout()
    {
        return '/logout';
    }
}
