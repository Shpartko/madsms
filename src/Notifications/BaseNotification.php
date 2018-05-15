<?php

namespace Shpartko\Madsms\Notifications;

use Illuminate\Support\Collection;
use Illuminate\Notifications\Notification;

/**
 * Abstract class for MadSMS notifications placed at Shpartko/Madsms/Notifications/Notifications
 *
 * @package Shpartko\Madsms
 */
abstract class BaseNotification extends Notification
{
    public function via(): array
    {
        $notificationChannels = config('madsms.notifications.notifications.'.static::class);

        return array_filter($notificationChannels);
    }

    public function applicationName(): string
    {
        return config('app.name') ?? config('app.url') ?? 'Laravel application';
    }

}