<?php

namespace Bloge\Content;

use Bloge\DataMappers\IDataMapper;
use Bloge\DataMappers\DataMapper;
use Bloge\Dispatchers\Dispatcher;
use Bloge\Dispatchers\IDispatcher;
use Bloge\NotFoundException;
use Bloge\Processors\IProcessor;
use Bloge\Processors\Processor;

class Advanced implements IAdvanced
{
    /**
     * @var \Bloge\Content\IContent
     */
    protected $content;
    
    /**
     * @var \Bloge\DataMappers\IDataMapper
     */
    protected $dataMapper;
    
    /**
     * @var \Bloge\Dispatchers\IDispatcher
     */
    protected $dispatcher;
    
    /**
     * @var \Bloge\Processors\IProcessor
     */
    protected $processor;
    
    /**
     * @param \Bloge\Content\IContent $content
     * @param \Bloge\DataMappers\IDataMapper $dataMapper
     * @param \Bloge\Dispatchers\IDispatcher $dispatcher
     * @param \Bloge\Processors\IProcessor $processor
     */
    public function __construct(
        IContent $content, 
        IDataMapper $dataMapper = null,
        IDispatcher $dispatcher = null,
        IProcessor $processor = null
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
        $data  = $this->dataMapper->data($route);
        $route = $this->dispatcher->dispatch($route);
        
        $data = array_merge($data, $this->content->fetch($route, $data));
        $data = $this->processor->process($route, $data);
        
        if (!$data) {
            throw new NotFoundException($route);
        }
        
        return $data;
    }
}