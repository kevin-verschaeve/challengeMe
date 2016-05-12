<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;
use Symfony\Component\Routing\Router;

class NikePlus extends AbstractApplicationConnector
{
    const API_PATH_PREFIX = '/v1/me';

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
