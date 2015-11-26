<?php

namespace Bloge\Basic;

class Wrapper implements \Bloge\Content
{
    /**
     * @var \Bloge\Content $content
     */
    protected $content;
    
    /**
     * @param \Bloge\Content $content
     */
    public function __construct(\Bloge\Content $content)
    {
        $this->content = $content;
    }
    
    /**
     * @{inheritDoc}
     */
    public function fetch($file, array $data = [])
    {
        return $this->content->fetch($file, $data);
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        return $this->content->browse($directory);
    }
}