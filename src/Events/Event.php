<?php

namespace Shpartko\Madsms\Events;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;

/**
 * Abstract class for events included gateway and message interfaces
 *
 * @package Shpartko\Madsms
 */
abstract class Event
{
    protected $gateway;
    protected $message;

    public function __construct(GatewayInterface $gateway, MessageInterface $message)
    {
        $this->gateway = $gateway;
        $this->message = $message;
    }

    public function getGateway() {
        return $this->gateway;
    }

    public function getMessage() {
        return $this->message;
    }
}
