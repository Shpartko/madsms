<?php

namespace Shpartko\Madsms\Gateway;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
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

	public function send(MessageInterface $message): MessageInterface
	{
		if ($message instanceof Message) {
			$message->type = 'standart';
			$message->message = $message->getMessage();
			$message->message_id = rand(11111111,999999999); // Message ID from mobile provider
			$message->status = array_random(['send','fail']);
			if (strlen($message->message)>$this->maximum_lenght_of_1sms) {
				$message->parts = ceil(strlen($message->message)/$this->maximum_lenght_of_1sms);
			}
		} else {
			$message->type = 'unconventional';
			$message->message = $message->getMessage();
			$message->message_id = null;
			$message->status = 'fail';
		}

		return $message;
	}
}
