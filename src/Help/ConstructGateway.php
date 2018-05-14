<?php

namespace Shpartko\Madsms\Help;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;

/**
 * This class needs extend to all final gateways classes
 *
 * @package Shpartko\Madsms
 */
abstract class ConstructGateway implements GatewayInterface
{
	public function isCorrectMessage(MessageInterface $message): bool
	{
		return true;
	}

	public function getGatewayName(): string {
		return $this->name;
	}

	public function getGatewayLogo(): string {
		return $this->logo;
	}
}