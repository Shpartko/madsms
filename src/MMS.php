<?php

namespace Shpartko\Madsms;

use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Help\ConstructMessage;

/**
 * Extended MMS message
 *
 * @package Shpartko\Madsms
 */
final class MMS extends ConstructMessage implements MessageInterface {
    protected $message_type = 'MMS';
    protected $image;

    public function __construct($phone, $message, $image=null) {
        parent::__construct($phone, $message);
        $this->image = $image;
    }

    public function getBase64(): string {
        return base64_encode($this->image);
    }
}
