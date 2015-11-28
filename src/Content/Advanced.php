<?php

namespace Bloge\Content;

use Bloge\DataMappers\DataMapper;
use Bloge\Dispatchers\Dispatcher;
use Bloge\NotFoundException;
use Bloge\Processors\Processor;

class Advanced implements IAdvancedContent
{
    /**
     * @var \Bloge\Content\Content
     */
    protected $content;
    
    /**
     * @var \Bloge\DataMappers\DataMapper
     */
    protected $dataMapper;
    
    /**
     * @var \Bloge\Dispatchers\Dispatcher
     */
    protected $dispatcher;
    
    /**
     * @var \Bloge\Processors\Processor
     */
    protected $processor;
    
    /**
     * @param \Bloge\Content\Content $content
     * @param \Bloge\DataMappers\DataMapper $dataMapper
     * @param \Bloge\Dispatchers\Dispatcher $dispatcher
     * @param \Bloge\Processors\Processor $processor
     */
    public function __construct(
        Content $content, 
        DataMapper $dataMapper = null,
        Dispatcher $dispatcher = null,
        Processor $processor = null
    ) {
        $this->content    = $content;
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
    public function fetch($route, array $data = [])
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