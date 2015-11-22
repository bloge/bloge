<?php 

/**
 * API draft
 * 
 * @package Bloge
 */

require 'vendor/autoload.php';

use Bloge\App;
use Bloge\Basic\Theme;
use Bloge\Basic\Content;

$bloge = new App;

echo $bloge->content(new Theme(__DIR__ . '/theme'))
           ->theme(new Content(__DIR__ . '/content'))
           ->render($_GET['route']);