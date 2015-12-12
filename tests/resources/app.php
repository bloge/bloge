<?php

/**
 * Basic Bloge app
 * 
 * @return \Bloge\Apps\IApp
 */

return new Bloge\Apps\BasicApp(
    new Bloge\Content\PHP(__DIR__ . '/content'),
    new Bloge\Renderers\PHP(__DIR__ . '/theme')
);