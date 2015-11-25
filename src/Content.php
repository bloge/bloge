<?php

namespace Bloge;

interface Content
{
    /**
     * @param string $file
     * @param array $data
     * @throws \Bloge\FileNotFoundException if file wasn't found
     * @return array
     */
    public function fetch($file, array $data = []);
    
    /**
     * @param string $directory
     * @return array
     */
    public function browse($directory = '');
}