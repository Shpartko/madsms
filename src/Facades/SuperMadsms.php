<?php

namespace Shpartko\Madsms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * SuperMadSMS Facade
 *
 * @package Shpartko\Madsms
 */
class SuperMadsms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
    	return 'supermadsms';
    }
}