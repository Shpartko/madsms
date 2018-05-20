<?php

namespace Shpartko\Madsms\Gateway;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Contracts\ReplyInterface;
use Shpartko\Madsms\Help\ConstructGateway;
use Shpartko\Madsms\Message;

/**
 * Gateway for LifeCell
 *
 * This operator can accept only sms and only 50 symbols max per 1 sms,
 * so we need to make parts for each 50 symbols and show how many sms was sended.
 *
 * @package Shpartko\Madsms
 */
final class Lifecell extends ConstructGateway implements GatewayInterface {
	protected $name = 'Life UKR';
	protected $logo = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3xhYmO9yH1wYUDkU3SuR6Ksy2JLnU_VELJ4wPcwVNyf4a2d0_';
	private $maximum_lenght_of_1sms = 50;

	protected function send(MessageInterface $message): MessageInterface
	{
		if ($message instanceof Message) {
			$message->reply()
				->setType(ReplyInterface::MESSAGE_TYPE_STANDART)
				->setId(rand(11111111,999999999))
				->setMessage($message->getMessage())
				->setResult(array_random([ReplyInterface::MESSAGE_SEND, ReplyInterface::MESSAGE_FAIL]));

				if (strlen($message->getMessage())>$this->maximum_lenght_of_1sms)
					$message->reply()
						->setParts(ceil(strlen($message->getMessage())/$this->maximum_lenght_of_1sms));
		} else {
			$message->reply()
				->setType(ReplyInterface::MESSAGE_TYPE_EXTENDED)
				->setMessage($message->getMessage())
				->setResult(ReplyInterface::MESSAGE_FAIL);
		}

		return $message;
	}
}
