<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;
use Symfony\Component\Routing\Router;

class Runkeeper implements ApplicationConnectorInterface
{
    public function __construct(Client $client, Router $router, $clientId, $clientSecret)
    {
    }

    public function authorize()
    {
    }

    public function login($code)
    {
    }

    public function getMe()
    {
    }

    public function getActivities()
    {
    }

    public function getActivity($idActitvity)
    {
    }

    public function getStats()
    {
    }

    public function revokeAuthorization()
    {
    }
}
