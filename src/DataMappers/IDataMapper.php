<?php

namespace Bloge\DataMappers;

/**
 * DataMapper interface
 * 
 * This interface is responsible for mapping data to routes according to set of 
 * rules
 * 
 * @package bloge
 */
interface IDataMapper
{
    /**
     * @param string $path
     * @return array
     */
    public function data($path);
}