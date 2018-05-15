<?php

namespace Shpartko\Madsms\Events;

use Shpartko\Madsms\Contracts\GatewayInterface;

/**
 * Event for get problems with connecting to remote gateway
 *
 * @package Shpartko\Madsms
 */
class CannotConnectToGateway
{
    private $gateway;

    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function getGateway() {
        return $this->gateway;
    }
}
