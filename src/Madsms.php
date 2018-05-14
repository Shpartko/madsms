<?php

namespace Shpartko\Madsms;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Contracts\ReplyInterface;
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
        $message->reply()->setGateway($this->gateway);

        if (($message->isCorrectMessage()) and ($this->gateway->isCorrectMessage($message))) {
            $this->gateway->send($message);

            if ($message->reply()->getResult() == ReplyInterface::MESSAGE_SEND) {
                Log::debug('MadSMS to '.$message->getPhone(), [
                    'provider' => $this->gateway->getGatewayName(),
                    'id' => $message->reply()->getId(),
                ]);
            } else {
                Log::warning('MadSMS to '.$message->getPhone().' not sended', [
                    'provider' => $this->gateway->getGatewayName(),
                    'id' => $message->reply()->getId(),
                ]);
            }
        } else {
            Log::error('Cannot send madSMS to '.$message->getPhone().' - wrong format or incorrect phone number', [
                'provider' => $this->gateway->getGatewayName(),
            ]);
        }

        return $message;
    }

    public function getGateway(): GatewayInterface
    {
        return $this->gateway;
    }
}
