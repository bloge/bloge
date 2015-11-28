<?php

namespace Bloge\Processors;

/**
 * Processor interface
 * 
 * Implementation of interface is responsible for content data post processing
 * 
 * @package Bloge
 */
interface IProcessor
{
    /**
     * @param string $path
     * @param array $data
     * @return array
     */
    public function process($path, array $data);
}