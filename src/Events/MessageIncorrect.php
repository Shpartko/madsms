<?php

namespace Shpartko\Madsms\Events;

use Shpartko\Madsms\Contracts\GatewayInterface;
use Shpartko\Madsms\Contracts\MessageInterface;
use Shpartko\Madsms\Events\Event;

/**
 * Event for get error for incorrect message format
 *
 * @package Shpartko\Madsms
 */
class MessageIncorrect extends Event
{

}
