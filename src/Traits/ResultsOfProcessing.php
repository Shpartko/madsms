<?php

namespace Shpartko\Madsms\Traits;

/**
 * Class for save processing results into private $processing_results variable
 * and grant access to this results over magic methods.
 *
 * !!! DON'T USE !!! REMOVED AFTER REFACTORING MessageInterface
 *
 * @package Shpartko\Madsms
 */
trait ResultsOfProcessing
{
	private $processing_results;

    public function __get($key)
    {
        if (isset($this->processing_results[$key])) {
            return $this->processing_results[$key];
        }
        return null;
    }

    public function __set($key, $value)
    {
        $this->processing_results[$key] = $value;
    }
}
