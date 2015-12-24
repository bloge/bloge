<?php

namespace Bloge\Compilers;

use Exception;

use Bloge\Apps\IApp;
use Bloge\NotDirectoryException;
use Bloge\NotFoundException;
use Bloge\NotWritableException;

/**
 * HTML compiler
 * 
 * Compiles content provided by app into static HTML website.
 * 
 * @package bloge
 */

class HTML implements ICompiler
{
    /**
     * @var \Bloge\IApp $app
     */
    protected $app;
    
    /**
     * @param \Bloge\IApp $app
     */
    public function __construct(IApp $app)
    {
        $this->app = $app;
    }
    
    /**
     * @{inheritDoc}
     */
    public function isBuildable($destination)
    {
        if (!is_dir($destination)) {
            throw new NotDirectoryException($destination);
        }
        
        if (!is_writable($destination)) {
            throw new NotWritableException($destination);
        }
        
        return true;
    }
    
    /**
     * @{inheritDoc}
     */
    public function build($path, $destination)
    {
        $destination = chop($destination, '/');
        
        $name    = $this->processPath($path);
        $content = $this->app->render($path);
            
        \Bloge\expandPath($name, $destination);
        
        file_put_contents("$destination/$name", $content);
    }
    
    /**
     * @param string $path
     * @return string
     */
    private function processPath($path)
    {
        if (\Bloge\endsWith($path, 'index')) {
            $path .= '.html';
        }
        
        if (!\Bloge\hasExtension($path)) {
            $path .= '/index.html';
        }
        
        return chop($path, '/');
    }
}