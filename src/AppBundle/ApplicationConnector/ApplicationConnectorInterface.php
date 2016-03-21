<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;

interface ApplicationConnectorInterface
{
    public function __construct(Client $client);

    public function login();

    public function logout();
}
