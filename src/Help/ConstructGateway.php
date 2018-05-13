<?php

namespace Shpartko\Madsms\Help;

use Shpartko\Madsms\Contracts\GatewayInterface;

/**
 * This class needs extend to all final gateways classes
 *
 * @package Shpartko\Madsms
 */
abstract class ConstructGateway implements GatewayInterface
{
	public function getGatewayName(): string {
		return $this->name;
	}

	public function getGatewayLogo(): string {
		return $this->logo;
	}
}