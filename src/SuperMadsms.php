<?php

namespace Shpartko\Madsms;

use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Exceptions\GatewaysException;
use Shpartko\Madsms\Madsms;

/**
 * MadSMS final class for sending mesages - one instance provide all avaible gateways
 *
 * @package Shpartko\Madsms
 */
final class SuperMadsms {
	private static $instances;

    public function __construct(array $gateways)
    {
        foreach ($gateways as $gateway) {
            self::$instances[] = new Madsms(new $gateway());
        }
        if (!self::$instances)
            throw GatewaysException::no_one_gateway_for_load();
    }

    public static function sendPool(array $pool): array
    {
        $results = [];
        foreach($pool as $message) {
            self::send($message);
            $results[] = $message;
        }
        return $results;
    }

    public static function send(MessageInterface $message): MessageInterface
    {
        return array_random(self::$instances)->send($message);
    }

    public static function getRandomGateway(): GatewayInterface
    {
        return array_random(self::$instances)->getGateway();
    }

}
