<?php

namespace Shpartko\Madsms;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Contracts\ReplyInterface;
use Shpartko\Madsms\Exceptions\GatewaysException;
use Shpartko\Madsms\Events\CannotConnectToGateway;
use Shpartko\Madsms\Events\MessageWasSend;
use Shpartko\Madsms\Events\MessageCannotSend;
use Shpartko\Madsms\Traits\SendNotification;

use Log;

/**
 * MadSMS final class for end-point usage - one instance provide one gateway
 *
 * @package Shpartko\Madsms
 */
final class Madsms {
	use SendNotification;

    private $gateway;

    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;

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
        $this->gateway->sendMessage($message);

        if ($message->reply()->getResult() == ReplyInterface::MESSAGE_SEND) {
            $this->sendNotification(new MessageWasSend($this->gateway, $message));
            Log::debug('MadSMS to '.$message->getPhone(), [
                'provider' => $message->reply()->getGatewayName(),
                'id' => $message->reply()->getId(),
            ]);
        } else {
            $this->sendNotification(new MessageCannotSend($this->gateway, $message));
            Log::warning('MadSMS to '.$message->getPhone().' not sended', [
                'provider' => $message->reply()->getGatewayName(),
                'id' => $message->reply()->getId(),
            ]);
        }

        return $message;
    }

    public function getGateway(): GatewayInterface
    {
        return $this->gateway;
    }
}
