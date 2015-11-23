<?php

namespace Bloge;

interface Filter
{
    /**
     * @param array $data
     * @return array 
     */
    public function filter(array $data);
    
    /**
     * @param mixed $item
     * @return mixed
     */
    public function filterItem($item);
}