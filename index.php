<?php 

/**
 * API draft
 * 
 * @package Bloge
 */

require 'vendor/autoload.php';

use Bloge\Basic\App;

$bloge = new App(__DIR__);

$bloge->theme('theme')
    ->content('content')
    ->plugin('\Bloge\twig')
    ->plugin('\Bloge\markdown')
    ->plugin('\Bloge\drafts');

echo $bloge->render($_GET['route']);

