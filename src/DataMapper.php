<?php

namespace Bloge;

/**
 * DataMapper interface
 * 
 * This interface is responsible for mapping data to routes according to set of 
 * rules
 * 
 * @package Bloge
 */
interface DataMapper
{
    /**
     * @param string $path
     * @return array
     */
    public function data($path);
}