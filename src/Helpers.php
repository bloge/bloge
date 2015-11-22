<?php

namespace Bloge;

/**
 * @param string $directory
 * @param string $basepath
 * @return array
 */
function listFiles($directory, $basepath = '') {
    $iterator = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($directory), 
        \RecursiveIteratorIterator::SELF_FIRST
    );
    
    $files = array_map('strval', iterator_to_array($iterator));
    $files = array_filter($files, function ($str) {
        return strpos($str, '/.') === false; 
    });
    
    if ($basepath) {
        $files = array_map(
            function ($file) use ($basepath) {
                return strpos($file, strlen($basepath));
            }, 
            $files
        );
    }
    
    return array_values($files);
}

/**
 * @param string $path
 * @param string $basepath
 */
function mkdirPath($path, $basepath = '')
{
    $frags = explode('/', trim($path, '/'));
    $path  = rtrim($basepath, '/') . '/';
    
    while ($frags) {
        $frag  = array_shift($frags);
        $path .= "$frag/";
        
        if (!file_exists($path) && strpos($frag, '.') === false) {
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