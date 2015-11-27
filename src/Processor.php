<?php

namespace Bloge;

/**
 * Processor interface
 * 
 * This class is responsible for content data post processing
 * 
 * @package Bloge
 */
interface Processor
{
    /**
     * @param string $path
     * @param array $data
     * @return array
     */
    public function process($path, array $data);
}