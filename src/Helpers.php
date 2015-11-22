<?php

namespace Bloge;

/**
 * @param string $directory
 * @param string $basepath
 * @return array
 */
function listFiles($directory, $basepath = '') {
    $files = getFiles(new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($directory)
    ), $basepath);
    
    $files = array_filter($files, '\Bloge\isFileHidden');
    
    return $files;
}

/**
 * @param \Iterator $iterator
 * @param string $basepath
 * @return array
 */
function getFiles(\Iterator $iterator, $basepath = '')
{
    $files = [];
    $length = strlen($basepath);
    
    foreach ($iterator as $file) {
        if (!$file->isFile()) {
            continue;
        }
        
        $files[] = substr($file, $length);
    }
    
    return $files;
}

/**
 * @param string $file
 * @return bool
 */
function isFileHidden ($file) {
    return strpos($file, '/.') === false; 
}

/**
 * @param string $path
 * @param string $basepath
 */
function mkdirPath($path, $basepath = '')
{
    $frags = explode('/', trim($path, '/'));
    $path  = rtrim($basepath, '/');
    
    while ($frags) {
        $frag  = array_shift($frags);
        $path .= "/$frag";
        
        if (!file_exists($path) && strpos($frag, '.') <= 0) {
            mkdir($path);
        }
    }
}

/**
 * @param string $__view__
 * @param array $__data__
 */
function render ($__view__, array $__data__) {
    extract($__data__);
    
    require($__view__);
}