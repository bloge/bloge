<?php

namespace Bloge;

/**
 * @internal
 */

/**
 * @param string $directory
 * @param string $basepath
 * @return array
 */
function listFiles($directory, $basepath = '') {
    $files = getFiles(
        new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($directory)), 
        $basepath
    );
    
    return array_filter($files, '\Bloge\isFileHidden');
}

/**
 * @param \Iterator $iterator
 * @param string $basepath
 * @return array
 */
function getFiles(\Iterator $iterator, $basepath = '')
{
    $files = [];
    $length = strlen($basepath) + 1;
    
    foreach ($iterator as $file) {
        if (!$file->isFile()) continue;
        
        $file = substr($file, $length);
        $dot = strrpos($file, '.');
        
        $files[] = $dot === false ? $file : substr($file, 0, $dot);
    }
    
    return $files;
}

/**
 * @param string $file
 * @return bool
 */
function isFileHidden($file) {
    return strpos($file, '/.') === false; 
}

/**
 * @param string $file
 * @return bool
 */
function hasExtension($file) {
    return pathinfo($file, PATHINFO_EXTENSION) !== '';
}

/**
 * @param string $string
 * @param string $needle
 * @return string
 */
function endsWith($string, $needle) {
    return strrpos($string, $needle) === strlen($string) - strlen($needle);
}

/**
 * @param string $path
 * @param string $basepath
 */
function expandPath($path, $basepath = '') {
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
 * @param string $file
 * @return string
 */
function globPath($file) {
    return current(glob("$file.*")) ?: $file;
}

/**
 * @param string $__view__
 * @param array $__data__
 * @return string
 */
function render($__view__, array $__data__) {
    ob_start();
    
    extract($__data__);
    require($__view__);
    
    return ob_get_clean();
}

/**
 * @param string $__view__
 * @param array $__data__
 * @return string
 */
function renderData($__view__, array $__data__) {
    ob_start();
    
    extract($__data__);
    
    $data = (require $__view__) ?: [];
    $data['content'] = ob_get_clean();
    
    return $data;
}