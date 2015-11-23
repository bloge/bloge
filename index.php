<?php 

/**
 * API draft
 * 
 * @package Bloge
 */

require 'vendor/autoload.php';

use Bloge\Basic\App;
use Bloge\Basic\Theme;
use Bloge\Basic\Content;

$bloge = (new App(__DIR__))
    ->theme('theme')
    ->content('content')
    ->plugin('\Bloge\twig')
    ->plugin('\Bloge\markdown')
    ->plugin('\Bloge\drafts');

$creator = new Creator(new Content);

$creator->data($data)
    ->data($markdown)
    ->filter($mapper)
    ->filter($filter);

$creator->browse();

echo $bloge->render($_GET['route']);