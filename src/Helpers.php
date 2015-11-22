<?php

namespace Bloge;

/**
 * @param string $basepath
 * @return array
 */
function listFiles($basepath) {
    $iterator = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($basepath), 
        \RecursiveIteratorIterator::SELF_FIRST
    );

    return array_values(
        array_filter(
            array_map('strval', iterator_to_array($iterator)),
            function ($str) {
                return strpos($str, '/.') === false; 
            }
        )
    );
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