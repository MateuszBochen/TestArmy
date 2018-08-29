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
        return $this->get('repository.device')->getAllAcceptedDevices();
    }

    /**
     * @Route("/device/{device}")
     * @Method("GET")
     * @Rest\View(statusCode=200)
     * @param Device $device
     * @return Device|array
     */
    public function getOneAction(Device $device)
    {
        if($device->getAccepted()) {
            return $device;
        }

        return ['this device is not Accepted'];
    }

    /**
     * Co do tej metody nie jestem przekonany czy tak może być, bo zgodnie z RESTApi
     * request PUT powinien nadpisywac cały zasób, a nie aktualizowąć tylko jedno pole.
     *
     * @Route("/device/{device}/approve")
     * @Method("PUT")
     * @Rest\View(statusCode=200)
     * @param Device $device
     * @return Device|array
     */
    public function approveAction(Device $device)
    {
        $repository = $this->get('repository.device');
        $device->setAccepted(true);
        $repository->save($device);
        return $device;
    }

    /**
     * @Route("/device/{device}/delete")
     * @Method("DELETE")
     * @Rest\View(statusCode=204)
     * @param Device $device
     */
    public function deleteAction(Device $device)
    {
        $repository = $this->get('repository.device');
        $repository->remove($device);
    }

    /**
     * @Route("/device")
     * @Method("POST")
     * @Rest\View(statusCode=201)
     * @param Request $request
     * @return Device|Response
     */
    public function postAction(Request $request)
    {
        $device = new Device();
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $domainDeviceCreateNewDevice = $this->get('domain.device.create_new_device');
            $domainDeviceCreateNewDevice->create($device);
            return $device;
        }

        return (new FormException(406, $form))->response();
    }
}
