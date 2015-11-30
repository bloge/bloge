<?php

namespace Bloge\Content;

use Bloge\NotFoundException;

/**
 * Array content mock
 * 
 * @package bloge
 */
class Arr implements IContent
{
    /**
     * @var array $content
     */
    protected $content;
    
    /**
     * @param array $content
     */
    public function __construct(array $content)
    {
        $this->content = $content;
    }
    
    /**
     * @{inheritDoc}
     */
    public function fetch($path, array $data = [])
    {
        if (!isset($this->content[$path])) {
            throw new NotFoundException($path);
        }
        
        return $this->content[$path];
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        return array_keys($this->content);
    }
}