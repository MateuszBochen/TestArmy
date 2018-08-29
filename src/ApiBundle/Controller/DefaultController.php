<?php

namespace ApiBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends FOSRestController
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Rest\View(statusCode=200)
     */
    public function indexAction()
    {
        return ['ok' => 'ok'];
    }
}
