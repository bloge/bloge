<?php

use Bloge\Content;

/**
 * \Bloge\Content interface implementation
 * 
 * Allows to "mock" \Bloge\Content with given array in constructor,
 * and furthermore use it tests.
 */
class ArrayContent implements Content
{
    /**
     * @var array $content
     */
    protected $content;
    
    /**
     * @param array $content
     */
    public function __construct(array $content = [])
    {
        $this->content = $content;
    }
    
    /**
     * @{inheritDoc}
     */
    public function fetch($file, array $data = [])
    {
        return isset($this->content[$file]) ? $this->content[$file] : [];
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        return array_keys($this->content);
    }
}