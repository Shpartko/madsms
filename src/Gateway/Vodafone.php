<?php

namespace Shpartko\Madsms\Gateway;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Help\ConstructGateway;
use Shpartko\Madsms\Message;

/**
 * Gateway for Vodafone
 *
 * This operator can accept sms and mms any length and processing of them at own side.
 *
 * @package Shpartko\Madsms
 */
final class Vodafone extends ConstructGateway implements GatewayInterface {
	protected $name = 'Vodafone (MTS) UKR';
	protected $logo = 'https://i.forbesimg.com/media/lists/companies/vodafone_416x416.jpg';

	public function send(MessageInterface $message): MessageInterface
	{
		if ($message instanceof Message) {
			$message->type = 'standart';
			$message->message = $message->getMessage();
		} else {
			$message->type = 'unconventional';
			$message->message = $message->getMessage().' *** BASE64: '.$message->getBase64();
		}

		$message->message_id = rand(11111111,999999999); // Message ID from mobile provider
		$message->status = array_random(['send','fail']);

		return $message;
	}
}
