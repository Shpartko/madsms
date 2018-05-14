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

];
