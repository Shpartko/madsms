<?php

namespace Shpartko\Madsms\Notifications\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Messages\SlackAttachment;
use Shpartko\Madsms\Notifications\BaseNotification;

use Shpartko\Madsms\Events\CannotConnectToGateway as RelatedEvent;

/**
 * Notification for get problems with connecting to remote gateway
 *
 * @package Shpartko\Madsms
 */
class CannotConnectToGateway extends BaseNotification
{
    protected $event;

    public function toMail(): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject(trans('madsms::notifications.slack_cannot_connect_to_gateway_title', ['application_name' => $this->applicationName()]))
            ->line(trans('madsms::notifications.slack_cannot_connect_to_gateway_body', ['gateway_name' => $this->getGatewayName()]));
        return $mailMessage;
    }

    public function toSlack(): SlackMessage
    {
        return (new SlackMessage)
            ->success()
            ->from(config('madsms.notifications.slack.username'), config('madms.notifications.slack.icon'))
            ->to(config('madsms.notifications.slack.channel'))
            ->content(trans('madsms::notifications.slack_cannot_connect_to_gateway', ['application_name' => $this->applicationName(), 'gateway_name' => $this->getGatewayName()]));
    }

    private function getGatewayName()
    {
        return $this->event->getGateway()->getGatewayName();
    }

    public function setEvent(RelatedEvent $event)
    {
        $this->event = $event;

        return $this;
    }
}
