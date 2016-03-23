<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;

class Runkeeper implements ApplicationConnectorInterface
{
    const APPLICATION_NAME = 'runkeeper';

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