<?php

namespace Shpartko\Madsms\Exceptions;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Exception;

class GatewaysException extends Exception
{
    public static function cannot_load_config()
    {
        return new static(__('madsms::msg.error-load-config'));
    }

    public static function cannot_connect(GatewayInterface $gateway)
    {
        return new static(__('madsms::msg.error-cannot-connect',['gateway' => $gateway->getGatewayName()]));
    }

    public static function no_one_gateway_for_load()
    {
        return new static(__('madsms::msg.error-no-one-gateway-for-load'));
    }

    public static function method_not_declared($methodName, $gatewayName)
    {
        return new static(__('madsms::msg.error-method-not-declared', compact('methodName', 'gatewayName')));
    }
}
