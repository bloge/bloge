<?php

namespace Bloge;

interface Theme
{
    /**
     * @param string $file
     * @param array $data
     * @throws \Bloge\FileNotFoundException
     * @return string
     */
    public function partial($file, array $data = []);
    
    /**
     * @param string $file
     * @param array $data
     * @return string
     */
    public function render($file, array $data = []);
}