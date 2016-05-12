<?php

namespace AppBundle\Controller;

use AppBundle\ApplicationConnector\ApplicationConnectorInterface;
use AppBundle\Document\Application;
use AppBundle\Document\UserApplication;
use Doctrine\ODM\MongoDB\DocumentManager;
use AppBundle\Document\User;
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
     * @Route("/authorize/{applicationName}", name="application_authorize")
     */
    public function authorizeApplication($applicationName)
    {
        return $this->getApplicationConnector($applicationName)->authorize();
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
        $userApplication = $dm->getRepository(UserApplication::class)->findOneBy([
            'application_user_id' => $user->id,
        ]);

        if (!$userApplication) {
            $userApplication = new UserApplication();
        }

        $tmp = $dm->getRepository(User::class)->findOneByUsername('Kevin');

        $userApplication->setApplication($application);
        $userApplication->setAccessToken($accessToken);
        $userApplication->setUser($tmp);

        $dm->persist($userApplication);
        $dm->flush();

        return $this->redirectToRoute('getme', ['applicationName' => $applicationName]);
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
