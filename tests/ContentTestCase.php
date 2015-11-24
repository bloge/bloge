<?php

class ContentTestCase extends TestCase
{
    public function content()
    {
        return new ArrayContent(
            require __DIR__ . '/resources/content.php'
        );
    }
}