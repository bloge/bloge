<?php

use Bloge\Processors\Processor;

class ProcessorTest extends TestCase
{
    public function processors()
    {
        $markdown = function ($path, array $data) {
            if (isset($data['content'])) {
                $data['content'] = "<p>{$data['content']}</p>";
            }
        
            return $data;
        };
        
        $path = function ($path, array $data) {
            $data['path'] = $path;
            
            return $data;
        };
        
        return [
            [
                'index',
                [
                    'title' => 'Hello',
                    'content' => 'Hello, **world**!'
                ],
                [$markdown],
                [
                    'title' => 'Hello',
                    'content' => '<p>Hello, **world**!</p>'
                ]
            ],
            [
                'projects',
                [
                    'title' => 'Hello',
                    'content' => 'Welcome! See my projects',
                ],
                [$markdown, $path],
                [
                    'title' => 'Hello',
                    'content' => '<p>Welcome! See my projects</p>',
                    'path' => 'projects'
                ]
            ]
        ];
    }
    
    /**
     * @dataProvider processors
     */
    public function testProcessor($path, $data, $processors, $expected)
    {
        $processor = new Processor;
        
        foreach ($processors as $callback) {
            $processor->add($callback);
        }
        
        $this->assertEquals($expected, $processor->process($path, $data));
    }
}