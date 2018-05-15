<?php

namespace Shpartko\Madsms\Events;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Events\Event;

/**
 * Event for any problems when message was not sended
 *
 * @package Shpartko\Madsms
 */
class MessageCannotSend extends Event
{

}
