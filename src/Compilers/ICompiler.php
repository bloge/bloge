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
     * @param \Bloge\IApp $app
     */
    public function __construct(IApp $app);
    
    /**
     * @param string $destination
     * @throws \Bloge\NotDirectoryException If $destination isn't a directory
     * @throws \Bloge\NotWritableException If $destination isn't writable
     * @return bool
     */
    public function isBuildable($destination);
    
    /**
     * Builds content file into $destination folder
     * 
     * @param string $path
     * @param string $destination
     */
    public function build($path, $destination);
}