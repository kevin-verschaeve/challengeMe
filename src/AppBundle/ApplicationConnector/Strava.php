<?php

namespace AppBundle\ApplicationConnector;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

class Strava implements ApplicationConnectorInterface
{
    const API_PATH_PREFIX = '/api/v3';

    private $client;
    private $router;
    private $clientId;
    private $clientSecret;

    private $accessToken;
    private $user;

    public function __construct(Client $client, Router $router, $clientId, $clientSecret)
    {
        $this->client = $client;
        $this->router = $router;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function authorize()
    {
        return new RedirectResponse(sprintf(
            '%s/%s?client_id=%d&response_type=code&redirect_uri=%s',
            $this->client->getConfig('base_uri'),
            'oauth/authorize',
            $this->clientId,
            $this->router->generate('application_connect', ['application' => 'strava'], UrlGeneratorInterface::ABSOLUTE_URL)
        ));
    }

    public function login($code)
    {
        $response = $this->format($this->client->post('/oauth/token',
            [
                'query' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'code' => $code,
                ]
            ]
        ));

        $this->accessToken = $response->access_token;
        $this->user = $response->athlete;

        return $this->accessToken;
    }

    public function getMe()
    {
        if (null === $this->user) {
            $this->user = $this->format(
                $this->client->get(
                    sprintf('%s/athlete', self::API_PATH_PREFIX),
                    [
                        'headers' => ['Authorization' => sprintf('Bearer %s', $this->accessToken)]
                    ]
                )
            );
        }

        return $this->user;
    }

    public function getActivities()
    {
        $response = $this->client->get(
            sprintf('%s/activities', self::API_PATH_PREFIX),
            [
                'headers' => ['Authorization' => sprintf('Bearer %s', $this->accessToken)]
            ]
        );

        return $this->format($response);
    }

    public function getActivity($idActivity)
    {
        $response = $this->client->get(
            sprintf('%s/activities/%s', self::API_PATH_PREFIX, $idActivity),
            [
                'headers' => ['Authorization' => sprintf('Bearer %s', $this->accessToken)]
            ]
        );

        return $this->format($response);
    }

    public function getStats()
    {
        $response = $this->client->get(
            sprintf('%s/athletes/%s/stats', self::API_PATH_PREFIX, $this->getMe()->id),
            [
                'headers' => ['Authorization' => sprintf('Bearer %s', $this->accessToken)]
            ]
        );

        return $this->format($response);
    }

    public function revokeAuthorization()
    {
        $this->client->post('/oauth/deauthorize', [
            'headers' => ['Authorization' => sprintf('Bearer %s', $this->accessToken)]
        ]);
    }

    private function format(ResponseInterface $response)
    {
        return json_decode($response->getBody()->__toString());
    }
}
