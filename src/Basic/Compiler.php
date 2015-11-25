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
        $destination = chop($destination, '/');
        
        if (!is_dir($destination)) {
            throw new NotDirectoryException($destination);
        }
        
        if (!is_writable($destination)) {
            throw new NotWritableException($destination);
        }
        
        foreach ($this->app->content()->browse() as $file) {
            $name = \Bloge\hasExtension($file) 
                ? $file 
                : "$file.html";
            
            if (strpos($name, 'index.html') === false) {
                $name = str_replace('.html', '/index.html', $name);
            }
            
            \Bloge\expandPath($name, $destination);
            file_put_contents("$destination/$name", $this->app->render($file));
        }
    }
}