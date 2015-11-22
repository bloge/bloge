<?php 

require 'vendor/autoload.php';

use Bloge\App;

$bloge = new App;

echo $bloge->content(__DIR__ . '/theme')
           ->theme(__DIR__ . '/content')
           ->render($_GET['route']);