<?php
/**
 * Created by PhpStorm.
 * User: backen
 * Date: 29.08.18
 * Time: 18:37
 */

namespace ApiBundle\Domain\Device;


use ApiBundle\Entity\Device;
use ApiBundle\Repository\DeviceRepository;

class CreateNewDevice
{
    /**
     * @var Device
     */
    private $device;

    private $handlersServices;
    private $deviceRepository;

    public function __construct(iterable $handlersServices, DeviceRepository $deviceRepository)
    {
        $this->handlersServices = $handlersServices;
        $this->deviceRepository = $deviceRepository;
    }

    public function create(Device $device)
    {
        $this->device = $device;

        $this->saveDevice();
        $this->runAllTaggedServices();
    }


    private function saveDevice()
    {
        $this->device->setAccepted(false);
        $this->deviceRepository->save($this->device);
    }

    private function runAllTaggedServices()
    {
        /** @var OnCreateNewDeviceAction $service */
        foreach ($this->handlersServices as $service) {
            if ($service instanceof OnCreateNewDeviceAction) {
                $service->setDevice($this->device);
                $service->action();
            }
        }
    }
}
