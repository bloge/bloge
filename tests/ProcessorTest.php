<?php

use Bloge\Basic\Processor;

class ProcessorTest extends TestCase
{
    public function processors()
    {
        $markdown = function ($file, array $data) {
            if (isset($data['content'])) {
                $data['content'] = "<p>{$data['content']}</p>";
            }
        
            return $data;
        };
        
        $file = function ($file, array $data) {
            $data['file'] = $file;
            
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
                [$markdown, $file],
                [
                    'title' => 'Hello',
                    'content' => '<p>Welcome! See my projects</p>',
                    'file' => 'projects'
                ]
            ]
        ];
    }
    
    /**
     * @dataProvider processors
     */
    public function testProcessor($file, $data, $processors, $expected)
    {
        $processor = new Processor;
        
        foreach ($processors as $callback) {
            $processor->add($callback);
        }
        
        $this->assertEquals($expected, $processor->process($file, $data));
    }
}