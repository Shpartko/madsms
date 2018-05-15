<?php

return [
    'title' => 'MadSMS',
    'h1' => 'Результат работы MadSMS:',

    'status-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_UNPROCESSED =>  'Не обработано',
    'status-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_SEND => 'Отправлено',
    'status-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_FAIL => 'Ошибка',

    'type-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_TYPE_UNDEFINED => 'Неизвестный формат',
    'type-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_TYPE_STANDART => 'Стандартное SMS',
    'type-'.Shpartko\Madsms\Contracts\ReplyInterface::MESSAGE_TYPE_EXTENDED => 'Не стандартное SMS, возможно MMS',

    'no-results' => 'Ни одно сообщение не было отправлено. Очередь сообщений пуста.',

    'error-load-config' => 'Не могу загрузить конфигурацию для работы MadSMS.',
    'error-cannot-connect' => 'Не могу соединиться со шлюзом :gateway для отправки SMS через MadSMS.',
    'error-no-one-gateway-for-load' => 'Не могу загрузить ни один шлюз для работы SuperMadSMS',
    'error-send-notifications' => 'Отсутствует связанный клас для оповещения о событии :eventClass. Пожалуйста, сконфигурируйте секцию madsms.notifications.notifications и создайте класс для оповещения об этом событии.',
];