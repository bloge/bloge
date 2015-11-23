<?php

namespace Bloge;

interface Creator extends Content
{
    /**
     * @param \Bloge\Content $content
     */
    public function __construct(Content $content);
    
    /**
     * @param \Bloge\Processor|callable $processor
     * @throws \InvalidArgumentException
     * @return \Bloge\Creator $this
     */
    public function data($processor);
    
    /**
     * @param \Bloge\Filter|callable $filter
     * @throws \InvalidArgumentException
     * @return \Bloge\Creator $this
     */
    public function filter($filter);
}