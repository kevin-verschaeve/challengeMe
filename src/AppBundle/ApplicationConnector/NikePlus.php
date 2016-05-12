<?php

namespace AppBundle\ApplicationConnector;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class NikePlus extends AbstractApplicationConnector
{
    const API_PATH_PREFIX = '/v1/me';

    public function authorize()
    {
        return new RedirectResponse(sprintf(
            '%s/%s?client_id=%d&redirect_uri=%s&response_type=code',
            $this->client->getConfig('base_uri'),
            'oauth/2.0/authorize',
            $this->clientId,
            $this->router->generate(
                'application_connect',
                ['applicationName' => 'nike_plus'],
                UrlGeneratorInterface::ABSOLUTE_URL
            )
        ));
    }
}
