<?php

namespace Bloge;

interface Processor
{
    /**
     * @param string $path
     * @param array $data
     * @return array
     */
    public function process($path, array $data);
}