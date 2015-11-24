<?php

namespace Bloge\Basic;

use Bloge\FileNotFoundException;
use Bloge\NotWritableException;

class Builder implements \Bloge\Builder
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
            throw NotDirectoryException($destination);
        }
        
        if (!is_writable($destination)) {
            throw NotWritableException($destination);
        }
        
        foreach ($this->app->creator()->browse() as $file) {
            $name = \Bloge\replaceExtension($file, 'html');
            
            if (strpos($name, 'index.html') === false) {
                $name = str_replace('.html', '/index.html', $name);
            }
            
            \Bloge\expandPath($name, $destination);
            file_put_contents("$destination/$name", $this->app->render($file));
        }
    }
}