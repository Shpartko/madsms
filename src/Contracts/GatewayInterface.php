<?php

namespace Shpartko\Madsms\Contracts;

use Shpartko\Madsms\Contracts\MessageInterface;

/**
 * All gateways needs use this interface
 *
 * @package Shpartko\Madsms
 */
interface GatewayInterface
{
	public function send(MessageInterface $message): MessageInterface;
	public function getGatewayName(): string;
	public function getGatewayLogo(): string;
}