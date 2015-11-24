<?php

namespace Bloge\Processors;

use Bloge\Processor;
use Parsedown;

/**
 * Markdown 
 * 
 * @author volter9
 */
class Markdown extends Parsedown implements Processor
{
    /**
     * @var array $fields
     */
    protected $fields;
    
    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields ?: ['content'];
    }
    
    /**
     * @{inheritDoc}
     */
    public function process($file, array $data)
    {
        foreach ($this->fields as $field) {
            $data[$field] = $this->text($data[$field]);
        }
        
        return $data;
    }
}