<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;
use Symfony\Component\Routing\Router;

class Runtastic extends AbstractApplicationConnector
{
    const API_PATH_PREFIX = '';

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
