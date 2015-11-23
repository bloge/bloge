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

$bloge = (new App(__DIR__))
    ->theme('theme')
    ->content('content')
    ->plugin('\Bloge\twig')
    ->plugin('\Bloge\markdown')
    ->plugin('\Bloge\drafts');

echo $bloge->render($_GET['route']);