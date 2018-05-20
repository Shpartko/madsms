<?php

namespace Shpartko\Madsms\Traits;

use Shpartko\Madsms\Events\MessageIncorrect;
use Log;

/**
 * Checking message before sending
 *
 * @package Shpartko\Madsms
 */
trait CheckMessage
{
    public function isCorrectMessage(): bool
    {
        $isCorrect = false;

        if (($this->getPhone()!='') and ($this->getMessage()!=''))
        	$isCorrect = true;

        // Make bad format for message for 1 of 5 times (for tests in dev mode)
        if ((env('APP_ENV')!='production') && (rand(0,4)==0))
            $isCorrect = false;

        if (!$isCorrect) {
            $this->sendNotification(new MessageIncorrect($this->reply()->getGateway(), $this));
            Log::error('Cannot send madSMS to '.$this->getPhone().' - wrong format or incorrect phone number', [
                'provider' => $this->reply()->getGateway()->getGatewayName(),
            ]);
        }

        return $isCorrect;
    }
}
