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
        $this->dispatcher = new Dispatcher;
    }
    
    public function dispatcher()
    {
        return $this->dispatcher;
    }
    
    /**
     * @{inheritDoc}
     */
    public function fetch($file, array $data = [])
    {
        $file = $this->dispatcher
            ->routes($this->content->browse())
            ->dispatch($file);
        
        return $this->content->fetch($file, $data);
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        return $this->dispatcher
                ->routes($this->content->browse($directory))
                ->compile();
    }
}