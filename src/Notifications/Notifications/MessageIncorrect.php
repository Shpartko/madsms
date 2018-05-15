<?php

namespace Shpartko\Madsms\Notifications\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Messages\SlackAttachment;
use Shpartko\Madsms\Notifications\BaseNotification;
use Shpartko\Madsms\Traits\RelatedEventProperties;

use Shpartko\Madsms\Events\MessageIncorrect as RelatedEvent;

/**
 * Notification for get error for incorrect message format
 *
 * @package Shpartko\Madsms
 */
class MessageIncorrect extends BaseNotification
{
    use RelatedEventProperties;

    public function toMail(): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject(trans('madsms::notifications.message_incorrect_title', ['application_name' => $this->applicationName()]))
            ->line(trans('madsms::notifications.message_incorrect_body', ['gateway_name' => $this->getGatewayName()]));

        $mailMessage->line('phone: '.$this->getPhoneNumber());
        $mailMessage->line('gateway: '.$this->getGatewayName());
        $mailMessage->line('message: '.$this->getMessage());

        return $mailMessage;
    }

    public function toSlack(): SlackMessage
    {
        return (new SlackMessage)
            ->success()
            ->from(config('madsms.notifications.slack.username'), config('madms.notifications.slack.icon'))
            ->to(config('madsms.notifications.slack.channel'))
            ->content(trans('madsms::notifications.slack_message_incorrect', ['application_name' => $this->applicationName(), 'gateway_name' => $this->getGatewayName()]))
            ->attachment(function (SlackAttachment $attachment) {
                 $attachment->fields([
                    'phone' => $this->getPhoneNumber(),
                    'gateway' => $this->getGatewayName(),
                    'message' => $this->getMessage(),
                 ]);
            })
            ;
    }
}
