<?php

namespace Bloge\Content;

class AdvancedTest extends \TestCase
{
    public function fileContent()
    {
        return require MAIN_DIR . '/content.php';
    }
    
    public function content()
    {
        return new Advanced(new Arr($this->fileContent()));
    }
    
    public function testDispatching()
    {
        $content = $this->content();
        $file = $this->fileContent();
        
        unset($file['_drafts/post']);
        
        $content->dispatcher()
            ->ignore('_drafts/post');
        
        $this->assertEquals(
            array_keys($file), 
            $content->browse()
        );
    }
    
    public function testDataMapping()
    {
        $content = $this->content();
        $file = $this->fileContent();
        
        $content->dataMapper()
            ->map('index', [
                'something' => 'random'
            ]);
        
        $this->assertEquals(
            array_merge($file['index'], [
                'something' => 'random'
            ]),
            $content->fetch('index')
        );
    }
    
    /**
     * @expectedException \Bloge\NotFoundException
     */
    public function testProcessing()
    {
        $content = $this->content();
        
        $content->processor()
            ->add(function () {
                return [];
            });
        
        $content->fetch('index');
    }
    
    /**
     * @expectedException \Bloge\NotFoundException
     */
    public function testFailingFetching()
    {
        $this->content()->fetch('foo');
    }
    
    public function testBrowsing()
    {
        $content = $this->content();
        
        $content->dispatcher()
            ->ignore('404')
            ->map('index', 'welcome');
        
        $this->assertNotEquals(
            $content->content()->browse(),
            $content->browse()
        );
    }
}