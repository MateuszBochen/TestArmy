<?php
/**
 * Created by PhpStorm.
 * User: backen
 * Date: 29.08.18
 * Time: 18:06
 */

namespace ApiBundle\Controller;

use ApiBundle\Entity\Device;
use ApiBundle\Form\DeviceType;
use ApiBundle\Helpers\FormException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeviceController extends FOSRestController
{
    /**
     * @Route("/device")
     * @Method("GET")
     * @Rest\View(statusCode=200)
     */
    public function getAction()
    {
        return ['ok' => 'ok'];
    }

    /**
     * @Route("/device")
     * @Method("POST")
     * @Rest\View(statusCode=201)
     * @param Request $request
     * @return array|Response
     */
    public function postAction(Request $request)
    {
        $device = new Device();
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $domainDeviceCreateNewDevice = $this->get('domain.device.create_new_device');
            $domainDeviceCreateNewDevice->create($device);
            return ['ok' => 'ok'];
        }

        return (new FormException(406, $form))->response();
    }
}
