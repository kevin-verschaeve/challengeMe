<?php

namespace AppBundle\Controller;

use AppBundle\ApplicationConnector\ApplicationConnectorInterface;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/oauth")
 * @NamePrefix("oauth")
 */
class OAuthController extends Controller
{
    /**
     * @param $application
     *
     * @Route("/authorize/{application}", name="application_authorize")
     */
    public function authorizeApplication($application)
    {
        return $this->getApplicationConnector($application)->authorize();
    }

    /**
     * @Route("/connect/{application}", name="application_connect")
     */
    public function connectAction(Request $request, $application)
    {
        $applicationConnector = $this->getApplicationConnector($application);

        $applicationConnector->login($request->query->getAlnum('code'));

        return $this->render('AppBundle:Oauth:connect.html.twig', [
            'user' => $applicationConnector->getMe(),
        ]);
    }

    /**
     * @Route("/revoke/{application}", name="application_revoke")
     */
    public function revokeAction($application)
    {
        $this->getApplicationConnector($application)->revokeAuthorization();
    }

    /**
     * @param $application
     * @return ApplicationConnectorInterface
     */
    protected function getApplicationConnector($application)
    {
        return $this
            ->container
            ->get('app.application.manager')
            ->getApplicationConnector($application)
        ;
    }
}
