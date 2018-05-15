<?php

namespace Shpartko\Madsms;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Contracts\ReplyInterface;
use Shpartko\Madsms\Exceptions\GatewaysException;
use Shpartko\Madsms\Events\CannotConnectToGateway;
use Shpartko\Madsms\Events\MessageWasSend;
use Shpartko\Madsms\Events\MessageCannotSend;
use Shpartko\Madsms\Events\MessageIncorrect;
use Log;

/**
 * MadSMS final class for end-point usage - one instance provide one gateway
 *
 * @package Shpartko\Madsms
 */
final class Madsms {
    private $gateway;
    private $sendNotifications;

    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
        $this->sendNotifications = config('madsms.notifications.send');

        // Make throw exception for 1 of 4 times (for tests in dev mode)
        if ((env('APP_ENV')!='production') && (rand(0,3)==0)) {
             $this->sendNotification(new CannotConnectToGateway($gateway));
             throw GatewaysException::cannot_connect($this->gateway);
        }
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
                $this->sendNotification(new MessageWasSend($this->gateway, $message));
                Log::debug('MadSMS to '.$message->getPhone(), [
                    'provider' => $this->gateway->getGatewayName(),
                    'id' => $message->reply()->getId(),
                ]);
            } else {
                $this->sendNotification(new MessageCannotSend($this->gateway, $message));
                Log::warning('MadSMS to '.$message->getPhone().' not sended', [
                    'provider' => $this->gateway->getGatewayName(),
                    'id' => $message->reply()->getId(),
                ]);
            }
        } else {
            $this->sendNotification(new MessageIncorrect($this->gateway, $message));
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

    private function sendNotification($notification)
    {
        if ($this->sendNotifications) {
            event($notification);
        }
    }
}
