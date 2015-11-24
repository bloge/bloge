<?php

use Bloge\Processors\DataMapper;

class DataMapperTest extends TestCase
{
    public function data()
    {
        return [
            [
                [
                    '/index' => [], 
                    '/404' => [], 
                    '/feed' => []
                ],
                [
                    '/index' => [], 
                    '/404' => [
                        'title' => 'Not found'
                    ],
                    '/feed' => [
                        'title' => 'feed.xml'
                    ]
                ]
            ]
        ];
    }
    
    /**
     * @dataProvider data
     */
    public function testMapping($data, $expected)
    {
        $mapper = new DataMapper;
        
        foreach ($expected as $key => $value) {
            $mapper->map($key, $value);
        }
        
        foreach ($data as $key => $value) {
            $data[$key] = $mapper->process($key, $value);
        }
        
        $this->assertEquals($expected, $data);
    }
}