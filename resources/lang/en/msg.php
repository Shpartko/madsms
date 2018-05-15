<?php

return [
    'title' => 'MadSMS',
    'h1' => 'MadSMS results page:',

    'status-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_UNPROCESSED =>  'Unprocessed',
    'status-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_SEND => 'Send compete',
    'status-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_FAIL => 'Send error',

    'type-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_TYPE_UNDEFINED => 'Undefined format',
    'type-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_TYPE_STANDART => 'Standart message',
    'type-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_TYPE_EXTENDED => 'Unconventional message',

    'no-results' => 'No one message was sended.',

    'error-load-config' => 'Cannot load MadSMS config.',
    'error-cannot-connect' => 'Cannot connect to :gateway gateway.',
    'error-no-one-gateway-for-load' => 'Cannot load gateways for SuperMadSMS',
    'error-send-notifications' => 'There is no notification class that can handle event :eventClass. Please, config section madsms.notifications.notifications and create notifycation for this event.',
];