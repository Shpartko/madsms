<?php

namespace Shpartko\Madsms\Exceptions;

use Exception;

class GatewaysException extends Exception
{
    public static function cannot_load_config()
    {
        return new static(__('madsms::msg.error-load-config'));
    }

    public static function cannot_connect($gateway)
    {
        return new static(__('madsms::msg.error-cannot-connect',['gateway' => $gateway]));
    }

    public static function no_one_gateway_for_load()
    {
        return new static(__('madsms::msg.error-no-one-gateway-for-load'));
    }
}