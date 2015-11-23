<?php

namespace Bloge;

interface Creator extends Content
{
    /**
     * @param \Bloge\Content $content
     */
    public function __construct(Content $content);
    
    /**
     * @param \Bloge\Processor $processor
     * @return \Bloge\Creator $this
     */
    public function data(Processor $processor);
    
    /**
     * @param \Bloge\Filter $filter
     * @return \Bloge\Creator $this
     */
    public function filter(Filter $filter);
}