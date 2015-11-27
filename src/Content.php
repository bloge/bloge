<?php

namespace Bloge;

interface Content
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