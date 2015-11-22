<?php

namespace Bloge;

interface Content
{
    /**
     * @param string $id
     * @return array
     */
    public function fetch($id);
    
    /**
     * @param string $id
     * @return bool
     */
    public function has($id);
}