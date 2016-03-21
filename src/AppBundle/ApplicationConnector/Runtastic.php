<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;

class Runtastic implements ApplicationConnectorInterface
{
    const APPLICATION_NAME = 'runtastic';

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
