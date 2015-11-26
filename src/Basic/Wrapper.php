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
    
    /**
     * @return \Bloge\Dispatcher
     */
    public function dispatcher()
    {
        return $this->dispatcher;
    }
    
    /**
     * @{inheritDoc}
     */
    public function fetch($file, array $data = [])
    {
        $content = $this->content;
        
        $file = $this->dispatcher
            ->fill($content->browse())
            ->dispatch($file);
        
        return $content->fetch($file, $data);
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        return array_keys(
            $this->dispatcher
                ->fill($this->content->browse($directory))
                ->compile()
        );
    }
}