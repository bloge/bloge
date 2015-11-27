<?php

namespace Bloge;

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