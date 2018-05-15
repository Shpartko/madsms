<?php

return [

    /*
    |--------------------------------------------------------------------------
    | List of gateways for SMS sending
    |--------------------------------------------------------------------------
    */

    'gateways' => [
        \Shpartko\Madsms\Gateway\Vodafone::class,
        \Shpartko\Madsms\Gateway\Lifecell::class,
        \Shpartko\Madsms\Gateway\Kyivstar::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Count of sms pool for one iteration
    |--------------------------------------------------------------------------
    */

    'limit_for_one_iteration' => 10,

    /*
    |--------------------------------------------------------------------------
    | Send errors, warnings and other notifycations for dev via email or slack
    |--------------------------------------------------------------------------
    */

    'notifications' => [

        'send' => false,

        'notifications' => [
            Shpartko\Madsms\Notifications\Notifications\CannotConnectToGateway::class => ['mail'],
            Shpartko\Madsms\Notifications\Notifications\MessageCannotSend::class => ['slack'],
            Shpartko\Madsms\Notifications\Notifications\MessageWasSend::class => [],
            Shpartko\Madsms\Notifications\Notifications\MessageIncorrect::class => ['slack'],
        ],

        'notifiable' => Shpartko\Madsms\Notifications\Notifiable::class,

        'mail' => [
            'to' => '3300101@gmail.com',
        ],

        'slack' => [
            'webhook_url' => 'https://hooks.slack.com/services/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',
            'channel' => '#mad',
            'username' => 'robot.mad',
            'icon' => '',
        ],

    ],

];
