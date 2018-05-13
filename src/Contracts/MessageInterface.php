<?php

namespace Shpartko\Madsms\Contracts;

/**
 * All types of messages needs use this interface
 *
 * @package Shpartko\Madsms
 */
interface MessageInterface {

    public function __construct($phone, $message);
    public function getPhone(): string;
    public function getMessage(): string;
    public function getBase64(): string;
    public function getMessageType(): string;

}
