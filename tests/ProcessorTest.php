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
    
    public function mappedData()
    {
        return [
            [
                'index',
                [
                    'title' => 'Hello',
                    'content' => 'World!'
                ],
                [
                    'index' => [
                        'language' => 'en'
                    ]
                ],
                [
                    'title' => 'Hello',
                    'content' => 'World!',
                    'language' => 'en'
                ]
            ],
            [
                'projects',
                [
                    'title' => 'Hello',
                    'content' => 'See my projects!'
                ],
                [
                    'index' => [
                        'language' => 'en'
                    ]
                ],
                [
                    'title' => 'Hello',
                    'content' => 'See my projects!'
                ]
            ],
            [
                '404',
                [
                    'title' => 'Hello',
                    'content' => 'See my projects!'
                ],
                [
                    '404' => [
                        'title' => '404 - Not Found'
                    ]
                ],
                [
                    'title' => '404 - Not Found',
                    'content' => 'See my projects!'
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
    
    /**
     * @dataProvider mappedData
     */
    public function testMapping($file, $data, $map, $expected)
    {
        $processor = new Processor;
        
        foreach ($map as $key => $value) {
            $processor->map($key, $value);
        }
        
        $this->assertEquals($expected, $processor->process($file, $data));
    }
}