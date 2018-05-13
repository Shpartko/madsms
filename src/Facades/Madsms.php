<?php

namespace Shpartko\Madsms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * MadSMS Facade
 *
 * @package Shpartko\Madsms
 */
class Madsms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
    	return 'madsms';
    }
}