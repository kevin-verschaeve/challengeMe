<?php

namespace AppBundle\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicationController extends Controller
{
    /**
     * @param Request $request
     * @param $applicationName
     * @return Response
     *
     * @Route("/me/{applicationName}", name="me")
     */
    public function getAction(Request $request, $applicationName)
    {
        $dm = $this->getDocumentManager();

//        $dm->getRepository(UserApplication::class)->find();
    }

    /**
     * @return DocumentManager
     */
    protected function getDocumentManager()
    {
        return $this->container->get('doctrine.odm.mongodb.document_manager');
    }
}
