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
     * @var \Bloge\Processor $processor
     */
    protected $processor;
    
    /**
     * @param \Bloge\Content $content
     * @param \Bloge\Dispatcher $content
     */
    public function __construct(
        \Bloge\Content $content,
        \Bloge\Dispatcher $dispatcher
    ) {
        $this->content = $content;
        $this->dispatcher = $dispatcher;
        $this->processor = new Processor;
        
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
     * @return \Bloge\Processor
     */
    public function processor()
    {
        return $this->processor;
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
        
        $data = $content->fetch($file, $data);
        
        return $this->processor->process($file, $data);
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