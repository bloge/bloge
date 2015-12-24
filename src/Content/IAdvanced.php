<?php

namespace Bloge\Content;

/**
 * Advanced content interface
 * 
 * This implementations of this interface should implement content's interface
 * and extend the behaviour of content's `browse` and `fetch` methods with 
 * dispatcher, data mapper and processor.
 * 
 * Dispatcher, data mapper and processor could be provided to user by invoking 
 * getters defined below.
 * 
 * @package bloge
 */
interface IAdvanced extends IContent
{
    /**
     * @return \Bloge\DataMappers\IDataMapper
     */
    public function dataMapper();
    
    /**
     * @return \Bloge\Dispatchers\IDispatcher
     */
    public function dispatcher();
    
    /**
     * @return \Bloge\Processors\IProcessor
     */
    public function processor();
}