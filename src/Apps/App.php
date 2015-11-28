<?php

namespace Bloge\Apps;

use Bloge\DataMappers\DataMapper;
use Bloge\Dispatchers\Dispatcher;
use Bloge\NotFoundException;
use Bloge\Processors\Processor;

class App implements \Bloge\PluggableApp
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
     * @var \Bloge\DataMapper
     */
    protected $dataMapper;
    
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
     * @param \Bloge\DataMapper $dataMapper
     * @param \Bloge\Dispatcher $dispatcher
     * @param \Bloge\Processor $processor
     */
    public function __construct(
        \Bloge\Content $content, 
        \Bloge\Renderer $renderer,
        \Bloge\DataMapper $dataMapper = null,
        \Bloge\Dispatcher $dispatcher = null,
        \Bloge\Processor $processor = null
    ) {
        $this->content  = $content;
        $this->renderer = $renderer;
        
        $this->dataMapper = $dataMapper ?: new DataMapper;
        $this->dispatcher = $dispatcher ?: new Dispatcher;
        $this->processor  = $processor  ?: new Processor;
    }
    
    /**
     * @{inheritDoc}
     */
    public function content()
    {
        return $this->content;
    }
    
    /**
     * @{inheritDoc}
     */
    public function dataMapper()
    {
        return $this->dataMapper;
    }
    
    /**
     * @{inheritDoc}
     */
    public function dispatcher()
    {
        return $this->dispatcher;
    }
    
    /**
     * @{inheritDoc}
     */
    public function processor()
    {
        return $this->processor;
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
        
        $data = array_merge($data, $content->fetch($route, $data));
        $data = $this->processor->process($route, $data);
        
        if (!$data) {
            throw new NoFoundException($route);
        }
        
        return $data;
    }
}