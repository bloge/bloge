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
        
        foreach ($app->content() as $file) {
            $name = $this->processFilePath(chop($file, '/'));
            
            \Bloge\expandPath($name, $destination);
            
            file_put_contents("$destination/$name", $app->render($file));
        }
    }
    
    /**
     * @param string $file
     * @return string
     */
    private function processFilePath($file)
    {
        if (\Bloge\endsWith($file, 'index')) {
            $file .= '.html';
        }
        
        if (!\Bloge\hasExtension($file)) {
            $file .= '/index.html';
        }
        
        return $file;
    }
}