<?php

namespace Bloge;

class NotWritableException extends \Exception 
{
    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        parent::__construct("Directory '$directory' isn't writable!");
    }
}