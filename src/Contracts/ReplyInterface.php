<?php

namespace Shpartko\Madsms\Contracts;

use Shpartko\Madsms\Contracts\GatewayInterface;

/**
 * Interface for reply from gateway
 *
 * @package Shpartko\Madsms
 */
interface ReplyInterface {
	const MESSAGE_UNPROCESSED = 90;
	const MESSAGE_SEND = 1;
	const MESSAGE_FAIL = -1;

	const MESSAGE_TYPE_UNDEFINED = 80;
	const MESSAGE_TYPE_STANDART = 1;
	const MESSAGE_TYPE_EXTENDED = 2;

	public function setGateway(GatewayInterface $gateway);

    public function setId(int $id);
    public function setMessage(string $message);
    public function setParts(int $parts);
    public function setType(int $type);
    public function setResult(int $result);

    public function getId();
    public function getMessage();
    public function getParts();
    public function getType();
    public function getResult();
    public function getGatewayName();
    public function getGatewayLogo();
}
