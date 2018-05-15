<?php

namespace Shpartko\Madsms\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Shpartko\Madsms\Events\CannotConnectToGateway;
use Shpartko\Madsms\Events\MessageWasSend;
use Shpartko\Madsms\Events\MessageCannotSend;
use Shpartko\Madsms\Events\MessageIncorrect;
use Shpartko\Madsms\Exceptions\NotificationCouldNotBeSent;

/**
 * Catch and merge events and notifications
 *
 * @package Shpartko\Madsms
 */
class EventHandler
{
    /** @var \Illuminate\Contracts\Config\Repository */
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = config();
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen($this->allEventClasses(), function ($event) {
            $notifiable = $this->determineNotifiable();
            $notification = $this->determineNotification($event);
            $notifiable->notify($notification);
        });
    }

    protected function determineNotifiable()
    {
        $notifiableClass = $this->config->get('madsms.notifications.notifiable');
        return app($notifiableClass);
    }

    protected function determineNotification($event): Notification
    {
        $eventName = class_basename($event);
        $notificationClass = collect($this->config->get('madsms.notifications.notifications'))
            ->keys()
            ->first(function ($notificationClass) use ($eventName) {
                $notificationName = class_basename($notificationClass);
                return $notificationName === $eventName;
            });
        if (! $notificationClass) {
            throw NotificationCouldNotBeSent::noNotifcationClassForEvent($event);
        }
        return app($notificationClass)->setEvent($event);
    }

    protected function allEventClasses(): array
    {
        return [
            CannotConnectToGateway::class,
            MessageWasSend::class,
            MessageCannotSend::class,
            MessageIncorrect::class,
        ];
    }
}
