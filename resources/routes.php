<?php

Route::get('madsms/{new_limit?}', function($new_limit = null){
    $mad = \App::make('madsms');
    $results = $mad->sendPool(getTestData($new_limit));

    return view('madsms::result', [
        'results' => $results,
    ]);
})->where(['new_limit' => '[0-9]+'])->name('madsms');


Route::get('supermadsms/{new_limit?}', function($new_limit = null){
    $mad = \App::make('supermadsms');
    $results = $mad->sendPool(getTestData($new_limit));

    return view('madsms::result', [
        'results' => $results,
    ]);
})->where(['new_limit' => '[0-9]+'])->name('supermadsms');


if(!function_exists("getTestData")) {
	function getTestData($new_limit) {
	    $max = config('madsms.limit_for_one_iteration',0);
	    if (($new_limit) and ($new_limit<101) and ($new_limit>0)) $max = $new_limit;

	    $pool = [];

	    $faker = \Faker\Factory::create();

	    for ($i=0; $i < $max; $i++) {
	        if (rand(0,1)==1) {
	            $pool[] = new Shpartko\Madsms\Message(
	                $faker->e164PhoneNumber(),
	                $faker->text(rand(100,300))
	            );
	        } else {
	            $pool[] = new Shpartko\Madsms\MMS(
	                $faker->e164PhoneNumber(),
	                $faker->text(rand(100,300)),
	                $faker->imageUrl()
	            );
	        }
	    }

	    return $pool;
	}
}