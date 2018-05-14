<?php

namespace Shpartko\Madsms\Gateway;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Contracts\ReplyInterface;
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
			$message->reply()
				->setType(ReplyInterface::MESSAGE_TYPE_STANDART)
				->setMessage($message->getMessage());
		} else {
			$message->reply()
				->setType(ReplyInterface::MESSAGE_TYPE_EXTENDED)
				->setMessage($message->getMessage().' *** BASE64: '.$message->getBase64());
		}

		// Save received message ID and result from mobile provider after processing
		$message->reply()
			->setId(rand(11111111,999999999))
			->setResult(array_random([ReplyInterface::MESSAGE_SEND, ReplyInterface::MESSAGE_FAIL]));

		return $message;
	}
}
