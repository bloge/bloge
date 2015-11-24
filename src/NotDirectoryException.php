<?php

namespace Bloge;

class NotDirectoryException extends \Exception 
{
    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        parent::__construct("'$directory' isn't a directory!");
    }
}