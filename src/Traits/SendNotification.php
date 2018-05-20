<?php

namespace Shpartko\Madsms\Traits;

/**
 * Sending notifications for events
 *
 * @package Shpartko\Madsms
 */
trait SendNotification
{
    protected function sendNotification($notification)
    {
        if (config('madsms.notifications.send')) {
            event($notification);
        }
    }
}
