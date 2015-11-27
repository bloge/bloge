<?php

namespace Bloge\Basic;

use Bloge\NotDirectoryException;
use Bloge\NotWritableException;

class Compiler implements \Bloge\Compiler
{
    /**
     * @var \Bloge\App $app
     */
    protected $app;
    
    /**
     * @param \Bloge\App $app
     */
    public function __construct(\Bloge\App $app)
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
        
        foreach ($app->content() as $path) {
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