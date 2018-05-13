<?php

namespace Shpartko\Madsms;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Exceptions\GatewaysException;
use Log;

/**
 * MadSMS final class for end-point usage - one instance provide one gateway
 *
 * @package Shpartko\Madsms
 */
final class Madsms {
    private $gateway;

    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;

        // Make throw exception for 1 of 4 times (for tests in dev mode)
        if ((env('APP_ENV')!='production') && (rand(0,3)==0))
             throw GatewaysException::cannot_connect($this->gateway->getGatewayName());
    }

    public function sendPool(array $pool): array
    {
        $results = [];
        foreach($pool as $message) {
            $this->send($message);
            $results[] = $message;
        }
        return $results;
    }

    public function send(MessageInterface $message): MessageInterface
    {
            if ($message->canMessageSend()) {
                $this->gateway->send($message);

                if ($message->status=='send') {
                    Log::debug('MadSMS to '.$message->getPhone(), [
                        'provider' => $this->gateway->getGatewayName(),
                        'id' => $message->message_id,
                        'status' => $message->status,
                    ]);
                } else {
                    Log::warning('MadSMS to '.$message->getPhone().' not sended', [
                        'provider' => $this->gateway->getGatewayName(),
                        'id' => $message->message_id,
                        'status' => $message->status,
                    ]);
                }
            } else {
                Log::error('Cannot send madSMS to '.$message->getPhone().' - wrong format or incorrect phone number', [
                    'provider' => $this->gateway->getGatewayName(),
                    'status' => $message->status,
                ]);
            }

            $message->gateway_name = $this->gateway->getGatewayName();
            $message->gateway_logo = $this->gateway->getGatewayLogo();

            return $message;
    }

    public function getGateway(): GatewayInterface
    {
        return $this->gateway;
    }
}
