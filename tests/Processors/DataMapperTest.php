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
        
        foreach ($expected as $k => $v) {
            $mapper->map($k, $v);
        }
        
        foreach ($data as $k => $v) {
            $data[$k] = $mapper->process($k, $v);
        }
        
        $this->assertEquals($expected, $data);
    }
}