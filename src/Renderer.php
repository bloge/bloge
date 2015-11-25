<?php

namespace Bloge;

interface Renderer
{
    /**
     * @param string $file
     * @param array $data
     * @return string
     */
    public function render($file, array $data = []);
}