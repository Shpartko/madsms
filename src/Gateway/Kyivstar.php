<?php

namespace Shpartko\Madsms\Gateway;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Help\ConstructGateway;
use Shpartko\Madsms\Message;

/**
 * Gateway for Kyivstar
 *
 * This operator can accept only sms and only 100 symbols max per 1 sms,
 * so we need to make parts for each 100 symbols and show how many sms was sended.
 *
 * @package Shpartko\Madsms
 */
final class Kyivstar extends ConstructGateway implements GatewayInterface {
	protected $name = 'Kyivstar UKR';
	protected $logo = 'https://www.utransto.com/images/mno/kyivstar_ukraine.png';
	private $maximum_lenght_of_1sms = 100;

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
