<?php

namespace AppBundle\Controller;

use AppBundle\ApplicationConnector\ApplicationConnectorInterface;
use AppBundle\Document\Application;
use AppBundle\Document\UserApplication;
use Doctrine\ODM\MongoDB\DocumentManager;
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
     * @Route("/connect/{applicationName}", name="application_connect")
     */
    public function connectAction(Request $request, $applicationName)
    {
        $applicationConnector = $this->getApplicationConnector($applicationName);

        $accessToken = $applicationConnector->login($request->query->getAlnum('code'));

        $user = $applicationConnector->getMe();

        /** @var DocumentManager $dm */
        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
        $application = $dm->getRepository(Application::class)->findByName($applicationName);
        /** @var UserApplication $userApplication */
        $userApplication = $dm->getRepository(UserApplication::class)->findBy(
            [
                'user_id' => $user->getId(),
                'application_id' => $application->getId(),
            ]
        );

        $userApplication->setApplication($application);
        $userApplication->setAccessToken($accessToken);
        $dm->persist($userApplication);
        $dm->flush();

        return $this->redirectToRoute('get_me', ['applicationName' => $applicationName]);
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
