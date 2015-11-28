<?php

namespace Bloge\Apps;

use Bloge\Dispatchers\Dispatcher;
use Bloge\Processors\Processor;
use Bloge\DataMappers\DataMapper;

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
     * @var \Bloge\DataMapper
     */
    protected $dataMapper;
    
    /**
     * @param \Bloge\Content $content
     * @param \Bloge\Renderer $renderer
     * @param \Bloge\Dispatcher $dispatcher
     * @param \Bloge\Processor $processor
     * @param \Bloge\Processor $dataMapper
     */
    public function __construct(
        \Bloge\Content $content, 
        \Bloge\Renderer $renderer,
        \Bloge\Dispatcher $dispatcher = null,
        \Bloge\Processor $processor = null,
        \Bloge\DataMapper $dataMapper = null
    ) {
        $this->content  = $content;
        $this->renderer = $renderer;
        
        $this->dispatcher = $dispatcher ?: new Dispatcher;
        
        $this->processor = $processor ?: new Processor;
        $this->dataMapper = $dataMapper ?: new DataMapper;
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
     * @return \Bloge\Processor
     */
    public function dataMapper()
    {
        return $this->dataMapper;
    }
    
    public function content()
    {
        return $this->content;
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
        $data = $this->dataMapper->data($route);
        
        $content = $this->content;
        $route   = $this->dispatcher->dispatch($route);
        $data    = array_merge($data, $content->fetch($route, $data));
        
        return $this->processor->process($route, $data);
    }
}