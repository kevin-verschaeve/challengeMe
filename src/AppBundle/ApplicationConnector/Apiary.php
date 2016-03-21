<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;

/**
 * Test only
 */
class Apiary implements ApplicationConnectorInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function login()
    {
        return $this->client->get('questions')->getBody();
    }

    public function logout()
    {
        return '/logout';
    }
}
