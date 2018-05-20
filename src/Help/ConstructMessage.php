<?php

namespace Shpartko\Madsms\Help;

use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Contracts\ReplyInterface;
use Shpartko\Madsms\Traits\CheckMessage;
use Shpartko\Madsms\Help\MessageReply;
use Shpartko\Madsms\Traits\SendNotification;

/**
 * This class needs extend to all final message types
 *
 * @package Shpartko\Madsms
 */
abstract class ConstructMessage implements MessageInterface
{
    use CheckMessage;
    use SendNotification;

    protected $phone;
    protected $message;
    protected $message_type;
    protected $reply;

    public function __construct($phone, $message) {
    	$this->phone = $phone;
    	$this->message = $message;

        $this->reply = new MessageReply();
    }

    public function getPhone(): string {
    	return $this->phone;
    }

    public function getMessage(): string {
    	return $this->message;
    }

    public function getBase64(): string {
        return '';
    }

    public function getMessageType(): string {
        return $this->message_type;
    }

    public function reply(): ReplyInterface {
        return $this->reply;
    }
}