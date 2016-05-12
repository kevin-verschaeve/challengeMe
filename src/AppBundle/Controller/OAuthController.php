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
        $application = $dm->getRepository(Application::class)->findOneByName(ucfirst($applicationName));
        /** @var UserApplication $userApplication */
        $userApplication = $dm->getRepository(UserApplication::class)->findOneBy(
            [
                'user_id' => $user->getId(),
                'application_id' => $application->getId(),
            ]
        );

        $userApplication->setApplication($application);
        $userApplication->setAccessToken($accessToken);
        $dm->persist($userApplication);
        $dm->flush();

        return $this->redirectToRoute('me', ['applicationName' => $applicationName]);
    }

    /**
     * @Route("/revoke/{applicationName}", name="application_revoke")
     */
    public function revokeAction($applicationName)
    {
        $this->getApplicationConnector($applicationName)->revokeAuthorization();
    }

    /**
     * @param $applicationName
     * @return ApplicationConnectorInterface
     */
    protected function getApplicationConnector($applicationName)
    {
        return $this
            ->container
            ->get('app.application.manager')
            ->getApplicationConnector($applicationName)
        ;
    }
}
