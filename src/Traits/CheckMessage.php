<?php

namespace Shpartko\Madsms\Traits;

/**
 * Checking message before sending
 *
 * @package Shpartko\Madsms
 */
trait CheckMessage
{
    public function isCorrectMessage(): bool
    {
    	// Make bad format for message for 1 of 5 times (for tests in dev mode)
    	if ((env('APP_ENV')!='production') && (rand(0,4)==0)) {
    		return false;
    	}

        if (($this->getPhone()!='') and ($this->getMessage()!='')) {
        	return true;
        }

        return false;
    }
}
