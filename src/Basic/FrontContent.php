<?php

namespace Bloge\Basic;

use Bloge\NotFoundException;

class FrontContent extends Content
{
    /**
     * @const string SEPARATOR Header and content separator
     */
    const SEPARATOR = "---\n";
    
    /**
     * @{inheritDoc} 
     */
    public function fetch($path, array $data = [])
    {
        $file = \Bloge\globPath($this->path($path));
        
        if (!is_file($file)) {
            throw new NotFoundException($path);
        }
        
        return $this->parse($file);
    }
    
    /**
     * @param string $file
     * @return array
     */
    private function parse($file)
    {
        $content = file_get_contents($file);
        
        $separator = strpos($content, self::SEPARATOR);
        $header = mb_substr($content, 0, $separator);
        
        $content = mb_substr($content, $separator + strlen(self::SEPARATOR));
        
        return compact('header', 'content');
    }
}