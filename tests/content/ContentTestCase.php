<?php

use Bloge\Content\ArrayContent;

class ContentTestCase extends TestCase
{
    public function content()
    {
        return new ArrayContent(
            require dirname(__DIR__) . '/resources/content.php'
        );
    }
}