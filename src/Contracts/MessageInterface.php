<?php

namespace Shpartko\Madsms\Contracts;

use Shpartko\Madsms\Contracts\ReplyInterface;

/**
 * All types of messages needs use this interface
 *
 * @package Shpartko\Madsms
 */
interface MessageInterface {
    public function __construct($phone, $message);
	public function isCorrectMessage(): bool;
    public function getPhone(): string;
    public function getMessage(): string;
    public function getBase64(): string;
    public function getMessageType(): string;
    public function reply(): ReplyInterface;
}
