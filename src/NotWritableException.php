<?php

namespace Bloge;

/**
 * NotWritable exception
 *
 * This subclass of Exception should be thrown in case if destination
 * directory isn't writable
 * 
 * @package bloge
 * @see \Bloge\Compiler
 */
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