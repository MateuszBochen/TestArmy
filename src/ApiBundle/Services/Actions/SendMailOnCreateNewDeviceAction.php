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
    private $mailer;

    /**
     * @param string $emailAddress
     * @param \Swift_Mailer $mailer
     */
    public function __construct(string $emailAddress, \Swift_Mailer $mailer)
    {
        $this->emailAddress = $emailAddress;
        $this->mailer = $mailer;
    }

    function setDevice(Device $device)
    {
        $this->device = $device;
    }

    public function action()
    {
        $link = '/api/device/'.$this->device->getId().'/approve';
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo($this->emailAddress)
            ->setBody('Link '.$link,
                'text/html'
            );


        $this->mailer->send($message);
    }
}
