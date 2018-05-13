<?php

namespace Shpartko\Madsms;

use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Help\ConstructMessage;

/**
 * Standart SMS message
 *
 * @package Shpartko\Madsms
 */
final class Message extends ConstructMessage implements MessageInterface {
    protected $message_type = 'SMS';

    public function __construct($phone, $message) {
    	parent::__construct($phone, $message);
    }
}
