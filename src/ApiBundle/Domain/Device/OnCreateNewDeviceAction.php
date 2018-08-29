<?php
/**
 * Created by PhpStorm.
 * User: backen
 * Date: 29.08.18
 * Time: 20:47
 */

namespace ApiBundle\Domain\Device;


use ApiBundle\Entity\Device;

interface OnCreateNewDeviceAction
{
    /**
     * Set Device Entity into event object
     * @param Device $device
     * @return
     */
    public function setDevice(Device $device);

    /**
     * This method is calling when Device is save successfully
     */
    public function action();
}
