<?php
/**
 * Created by PhpStorm.
 * User: backen
 * Date: 29.08.18
 * Time: 18:37
 */

namespace ApiBundle\Domain\Device;


use ApiBundle\Entity\Device;

class CreateNewDevice
{
    private $device;
    private $handlersServices;

    public function __construct(iterable $handlersServices)
    {
        $this->handlersServices = $handlersServices;
    }

    public function create(Device $device)
    {
        $this->device = $device;

        $this->saveDevice();

        $this->runAllTaggedSeries();
    }


    private function saveDevice()
    {

    }

    private function runAllTaggedSeries()
    {
        foreach($this->handlersServices as $service) {
            // run all all tagged series
        }
    }
}
