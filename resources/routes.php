<?php

Route::get('madsms/{new_limit?}', function($new_limit = null){
    $mad = \App::make('madsms');
    $max = config('madsms.limit_for_one_iteration',0);

    if (($new_limit) and ($new_limit<101) and ($new_limit>0)) $max = $new_limit;

    $results = $mad->sendPool(getTestData($max));

    return view('madsms::result', [
        'results' => $results,
    ]);
})->where(['new_limit' => '[0-9]+'])->name('madsms');


Route::get('supermadsms/{new_limit?}', function($new_limit = null){
    $mad = \App::make('supermadsms');
    $max = config('madsms.limit_for_one_iteration',0);

    if (($new_limit) and ($new_limit<101) and ($new_limit>0)) $max = $new_limit;

    $results = $mad->sendPool(getTestData($max));

    return view('madsms::result', [
        'results' => $results,
    ]);
})->where(['new_limit' => '[0-9]+'])->name('supermadsms');


function getTestData($max) {
    $pool = [];

    $faker = \Faker\Factory::create();

    for ($i=0; $i < $max; $i++) {
        if (rand(0,1)==1) {
            $pool[] = new Shpartko\Madsms\Message(
                $faker->e164PhoneNumber(),
                $faker->text(200)
            );
        } else {
            $pool[] = new Shpartko\Madsms\MMS(
                $faker->e164PhoneNumber(),
                $faker->text(200),
                $faker->imageUrl()
            );
        }
    }

    return $pool;
}