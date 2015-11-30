<?php

namespace Bloge\Compilers;

use Bloge\Apps\IApp;

/**
 * Compiler interface
 * 
 * Implementations of this interface are responsible for building dynamic
 * website/content into file flat HTML website
 * 
 * @package bloge
 */
interface ICompiler
{
    /**
     * @param \Bloge\IApp
     */
    public function __construct(IApp $app);
    
    /**
     * Builds content into $destination folder
     * 
     * @param string $destination
     * @throws \Bloge\NotDirectoryException If $destination isn't a directory
     * @throws \Bloge\NotWritableException If $destination isn't writable
     */
    public function build($destination);
}