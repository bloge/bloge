<?php

namespace Bloge\Basic;

class App implements \Bloge\App
{
    /**
     * @var \Bloge\Content
     */
    protected $content;
    
    /**
     * @var \Bloge\Renderer $renderer
     */
    protected $renderer;
    
    /**
     * @var \Bloge\Dispatcher
     */
    protected $dispatcher;
    
    /**
     * @var \Bloge\Processor
     */
    protected $postProcessor;
    
    /**
     * @var \Bloge\Processor
     */
    protected $preProcessor;
    
    /**
     * @param \Bloge\Content $content
     * @param \Bloge\Renderer $renderer
     * @param \Bloge\Dispatcher $dispatcher
     * @param \Bloge\Processor $postProcessor
     * @param \Bloge\Processor $preProcessor
     */
    public function __construct(
        \Bloge\Content $content, 
        \Bloge\Renderer $renderer,
        \Bloge\Dispatcher $dispatcher = null,
        \Bloge\Processor $postProcessor = null,
        \Bloge\Processor $preProcessor = null
    ) {
        $this->content  = $content;
        $this->renderer = $renderer;
        
        $this->dispatcher = $dispatcher ?: new Dispatcher;
        
        $this->postProcessor = $postProcessor ?: new Processor;
        $this->preProcessor  = $preProcessor ?: new Processor;
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
    public function postProcessor()
    {
        return $this->postProcessor;
    }
    
    /**
     * @return \Bloge\Processor
     */
    public function preProcessor()
    {
        return $this->preProcessor;
    }
    
    /**
     * @{inheritDoc}
     */
    public function browse($directory = '')
    {
        $content = $this->content;
        
        return array_keys(
            $this->dispatcher
                ->fill($content->browse($directory))
                ->compile()
        );
    }
    
    /**
     * @{inheritDoc}
     */
    public function render($route, array $data = [])
    {
        return $this->renderer->render($this->fetch($route, $data));
    }
    
    /**
     * @see \Bloge\Content::fetch
     */
    private function fetch($route, array $data = [])
    {
        $data = $this->preProcessor->process($route, $data);
        
        $content = $this->content;
        $route   = $this->dispatcher->dispatch($route);
        $data    = $content->fetch($route, $data);
        
        return $this->postProcessor->process($route, $data);
    }
}