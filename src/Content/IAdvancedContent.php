<?php

namespace Bloge\Content;

/**
 * Content interface
 * 
 * This interface is inspired by Repository interface. Implementation classes
 * should implement list all (or filtered by path) items and allow to get data 
 * contained in storage
 * 
 * @package Bloge
 */
interface IAdvancedContent extends Content
{
    /**
     * @return \Bloge\DataMappers\DataMapper
     */
    public function dataMapper();
    
    /**
     * @return \Bloge\Dispatchers\Dispatcher
     */
    public function dispatcher();
    
    /**
     * @return \Bloge\Processors\Processor
     */
    public function processor();
}