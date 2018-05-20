<?php

namespace Shpartko\Madsms\Help;

use Shpartko\Madsms\Contracts\ReplyInterface;
use Shpartko\Madsms\Contracts\GatewayInterface;

/**
 * Result of message processing by provider
 *
 * @package Shpartko\Madsms
 */
class MessageReply implements ReplyInterface
{
	private $id;
	private $type = ReplyInterface::MESSAGE_TYPE_UNDEFINED;

    private $message;
    private $parts;

    private $gateway;

    private $result = ReplyInterface::MESSAGE_UNPROCESSED;

    public function setGateway(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    	return $this;
    }

    public function setId(int $id)
    {
    	$this->id = $id;
    	return $this;
    }

    public function setMessage(string $message)
    {
    	$this->message = $message;
    	return $this;
    }

    public function setParts(int $parts)
    {
    	$this->parts = $parts;
    	return $this;
    }

    public function setType(int $type)
    {
    	$this->type = $type;
    	return $this;
    }

    public function setResult(int $result)
    {
    	$this->result = $result;
    	return $this;
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getMessage()
    {
    	return $this->message;
    }

    public function getType()
    {
    	return $this->type;
    }

    public function getParts()
    {
    	return $this->parts;
    }

    public function getResult()
    {
    	return $this->result;
    }

    public function getGateway()
    {
        return $this->gateway;
    }

    public function getGatewayName()
    {
    	return $this->gateway->getGatewayName();
    }

    public function getGatewayLogo()
    {
    	return $this->gateway->getGatewayLogo();
    }


}
