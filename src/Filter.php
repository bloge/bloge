<?php

namespace Bloge;

interface Filter
{
    /**
     * @param array $data
     * @return array 
     */
    public function filter(array $data);
}