<?php

namespace Shpartko\Madsms\Help;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Exceptions\GatewaysException;

/**
 * This class needs extend to all final gateways classes
 *
 * @package Shpartko\Madsms
 */
abstract class ConstructGateway implements GatewayInterface
{
	public function sendMessage(MessageInterface $message): MessageInterface
	{
		$message->reply()->setGateway($this);

		if (!$this->isCorrectMessage($message))
			return $message;

		return $this->send($message);
	}

	public function isCorrectMessage(MessageInterface $message): bool
	{
		return $message->isCorrectMessage();
	}

	public function getGatewayName(): string {
		return $this->name;
	}

	public function getGatewayLogo(): string {
		return $this->logo;
	}

	/*
	* Method must be redeclared in final class of GatewayInterface
	*/
	protected function send(MessageInterface $message): MessageInterface {
		throw GatewaysException::method_not_declared(__METHOD__, $this->getGatewayName());
	}
}