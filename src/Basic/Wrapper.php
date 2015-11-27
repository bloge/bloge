<?php

namespace Bloge\Basic;

class Wrapper implements \Bloge\Content
{
    /**
     * @var \Bloge\Content $content
     */
    protected $content;
    
    /**
     * @var \Bloge\Dispatcher $dispatcher
     */
    protected $dispatcher;
    
    /**
     * @param \Bloge\Content $content
     */
    public function __construct(
        \Bloge\Content $content,
        \Bloge\Dispatcher $dispatcher
    ) {
        $this->content = $content;
        $this->dispatcher = $dispatcher;
        
        $dispatcher->fill($content->browse());
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