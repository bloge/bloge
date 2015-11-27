<?php

namespace Bloge;

/**
 * Compiler interface
 * 
 * Implementations of this interface are responsible for building dynamic
 * website/content into file flat HTML website
 * 
 * @package Bloge
 */
interface Compiler
{
    /**
     * @param \Bloge\App
     */
    public function __construct(App $app);
    
    /**
     * Builds content into $destination folder
     * 
     * @param string $destination
     * @throws \Bloge\NotDirectoryException If $destination isn't a directory
     * @throws \Bloge\NotWritableException If $destination isn't writable
     */
    public function build($destination);
}