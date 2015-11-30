<?php

namespace Bloge;

/**
 * NotDirectory exception
 *
 * This subclass of Exception should be thrown in case if destination
 * directory isn't an actual directory
 * 
 * @package bloge
 * @see \Bloge\Compiler
 */
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