<?php

namespace Shpartko\Madsms\Notifications;

use Illuminate\Notifications\Notifiable as NotifiableTrait;

/**
 * Notifiable class for MadSMS
 *
 * @package Shpartko\Madsms
 */
class Notifiable
{
    use NotifiableTrait;

    public function routeNotificationForMail()
    {
        return config('madsms.notifications.mail.to');
    }

    public function routeNotificationForSlack()
    {
        return config('madsms.notifications.slack.webhook_url');
    }
}