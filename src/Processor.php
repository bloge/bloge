<?php

namespace Bloge;

interface Processor
{
    /**
     * @param string $file
     * @param array $data
     * @return array
     */
    public function process($file, array $data);
}