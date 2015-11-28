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
interface IContent
{
    /**
     * @param string $path
     * @param array $data
     * @throws \Bloge\NotFoundException if content wasn't found
     * @return array
     */
    public function fetch($path, array $data = []);
    
    /**
     * @param string $directory
     * @return array
     */
    public function browse($directory = '');
}