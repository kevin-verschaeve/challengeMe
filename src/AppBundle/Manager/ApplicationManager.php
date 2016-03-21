<?php

namespace AppBundle\Manager;

use AppBundle\ApplicationConnector\ApplicationConnectorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

class ApplicationManager
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $applicationName
     *
     * @return ApplicationConnectorInterface
     * @throws MissingMandatoryParametersException
     * @throws NotFoundHttpException
     */
    public function getApplicationConnector($applicationName)
    {
        if (!$applicationName) {
            throw new MissingMandatoryParametersException('"application" parameter is mandatory in order to continue');
        }

        if (!$this->container->has(sprintf('app.application.connector.%s', $applicationName))) {
            throw new NotFoundHttpException(sprintf('The given application "%s" is not handled by challengeMe', $applicationName));
        }

        return $this->container->get(sprintf('app.application.connector.%s', $applicationName));
    }
}
