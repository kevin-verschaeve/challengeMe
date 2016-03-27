<?php

namespace AppBundle\Controller;

use AppBundle\Document\User;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function getUsersAction()
    {
        return $this
            ->getDocumentManager()
            ->getRepository(User::class)
            ->findAll()
        ;
    }

    public function getUserAction($id)
    {
        // TODO use a ParamConverter, or ParamFetcher or QueryParam
        // @ParamConverter(name="user", class="AppBundle:User") //  make this working Bitch !
        return $this
            ->getDocumentManager()
            ->find(User::class, $id)
        ;
    }

    /**
     * TODO: use form validation
     *
     * @param $id
     * @param Request $request
     */
    public function putUserAction(Request $request, $id)
    {
        $dm = $this->getDocumentManager();
        /** @var User $user */
        $user = $dm->find(User::class, $id);

        $user->setUsernameCanonical($request->request->get('username'));
        $dm->flush();
    }

    /**
     * @return \Doctrine\ODM\MongoDB\DocumentManager
     */
    protected function getDocumentManager()
    {
        return $this->container->get('doctrine.odm.mongodb.document_manager');
    }
}
