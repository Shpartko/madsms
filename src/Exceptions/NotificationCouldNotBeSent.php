<?php

namespace Shpartko\Madsms\Exceptions;

use Exception;

class NotificationCouldNotBeSent extends Exception
{
    public static function noNotifcationClassForEvent($event): self
    {
        $eventClass = get_class($event);
        return new static(__('madsms::msg.error-send-notifications',['eventClass' => $eventClass]));
    }
}