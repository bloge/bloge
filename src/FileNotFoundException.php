<?php

namespace Bloge;

class FileNotFoundException extends \Exception 
{
    /**
     * @param string $file
     * @param string $basepath
     */
    public function __construct($file, $basepath = '')
    {
        $message = $basepath
            ? "File '$file' not found at '$basepath'!"
            : "File '$file' not found!";
        
        parent::__construct($message);
    }
}