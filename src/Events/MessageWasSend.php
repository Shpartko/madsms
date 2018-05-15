<?php

namespace Shpartko\Madsms\Events;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Events\Event;

/**
 * Event for message sent successfully without any errors
 *
 * @package Shpartko\Madsms
 */
class MessageWasSend extends Event
{

}
