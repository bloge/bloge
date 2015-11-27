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
    protected $processor;
    
    /**
     * @param \Bloge\Content $content
     * @param \Bloge\Renderer $renderer
     * @param \Bloge\Dispatcher $dispatcher
     * @param \Bloge\Processor $processor
     */
    public function __construct(
        \Bloge\Content $content, 
        \Bloge\Renderer $renderer,
        \Bloge\Dispatcher $dispatcher = null,
        \Bloge\Processor $processor = null
    ) {
        $this->content  = $content;
        $this->renderer = $renderer;
        
        $this->dispatcher = $dispatcher ?: new Dispatcher;
        $this->processor  = $processor ?: new Processor;
        
        $this->dispatcher->fill($content->browse());
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
    public function content($directory = '')
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
        $content = $this->content;
        
        $route = $this->dispatcher
            ->fill($content->browse())
            ->dispatch($route);
        
        $data = $content->fetch($route, $data);
        
        return $this->processor->process($route, $data);
    }
}