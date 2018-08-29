<?php
/**
 * Created by PhpStorm.
 * User: backen
 * Date: 29.08.18
 * Time: 19:46
 */

namespace ApiBundle\Services\Actions;

use ApiBundle\Domain\Device\OnCreateNewDeviceAction;
use ApiBundle\Entity\Device;

class SendMailOnCreateNewDeviceAction implements OnCreateNewDeviceAction
{

    private $device;
    private $emailAddress;

    /**
     * @param string $emailAddress
     */
    public function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    function setDevice(Device $device)
    {
        $this->device = $device;
    }


    public function action()
    {

    }

}
