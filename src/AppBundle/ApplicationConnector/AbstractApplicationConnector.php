<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;
use Symfony\Component\Routing\Router;

abstract class AbstractApplicationConnector implements ApplicationConnectorInterface
{
    protected $client;
    protected $router;
    protected $clientId;
    protected $clientSecret;

    public function __construct(Client $client, Router $router, $clientId, $clientSecret)
    {
        $this->client = $client;
        $this->router = $router;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }
}
