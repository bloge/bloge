<?php

namespace Bloge\Compilers;

use Bloge\Apps\IApp;
use Bloge\NotDirectoryException;
use Bloge\NotWritableException;

/**
 * HTML compiler
 * 
 * Compiles content provided by app into static HTML website
 * 
 * @package Bloge
 */
class HTMLCompiler implements ICompiler
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
    public function build($destination)
    {
        if (!is_dir($destination)) {
            throw new NotDirectoryException($destination);
        }
        
        if (!is_writable($destination)) {
            throw new NotWritableException($destination);
        }
        
        $app = $this->app;
        $destination = chop($destination, '/');
        
        foreach ($app->browse() as $path) {
            $name = $this->processPath(chop($path, '/'));
            
            \Bloge\expandPath($name, $destination);
            
            file_put_contents("$destination/$name", $app->render($path));
        }
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
        
        return $path;
    }
}