<?php

namespace Shpartko\Madsms\Traits;

use Shpartko\Madsms\Events\Event;

/**
 * Some functions for notifications for provide more data from called event
 *
 * @package Shpartko\Madsms
 */
trait RelatedEventProperties
{
    protected $event;

    private function getGatewayName()
    {
        return $this->event->getGateway()->getGatewayName();
    }

    private function getMessage()
    {
        return $this->event->getMessage()->getMessage();
    }

    private function getMessageId()
    {
        return $this->event->getMessage()->reply()->getId();
    }

    private function getPhoneNumber()
    {
        return $this->event->getMessage()->getPhone();
    }

    public function setEvent(Event $event)
    {
        $this->event = $event;

        return $this;
    }
}
