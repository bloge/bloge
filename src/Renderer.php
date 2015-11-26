<?php

namespace Bloge;

interface Renderer
{
    /**
     * @param array $data
     * @return string
     */
    public function render(array $data = []);
}