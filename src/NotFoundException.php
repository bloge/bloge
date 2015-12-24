<?php

namespace Bloge;

/**
 * NotFound exception
 * 
 * This subclass of Exception should be thrown in case if content 
 * file/row/array/data item wasn't found.
 */

class NotFoundException extends \Exception 
{
    /**
     * @param string $key
     */
    public function __construct($key)
    {
        parent::__construct("Value at key '$key' isn't found!");
    }
}