<?php

namespace Shpartko\Madsms\Help;

use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Traits\CheckMessage;
use Shpartko\Madsms\Traits\ResultsOfProcessing;

/**
 * This class needs extend to all final message types
 *
 * @package Shpartko\Madsms
 */
abstract class ConstructMessage implements MessageInterface
{
    use CheckMessage;
	use ResultsOfProcessing;

    protected $phone;
    protected $message;
    protected $message_type;

    public function __construct($phone, $message) {
    	$this->phone = $phone;
    	$this->message = $message;
        $this->type = 'undefined';
        $this->status = 'bad';
    }

    public function getPhone(): string {
    	return $this->phone;
    }

    public function getMessage(): string {
    	return $this->message;
    }

    public function getBase64(): string {
        return null;
    }

    public function getMessageType(): string {
        return $this->message_type;
    }
}