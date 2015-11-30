<?php

namespace Bloge;

/**
 * Internal Bloge functions
 * 
 * Do not, **I repeat**, do not rely on these functions. They're only for 
 * internal use withing this repository and only inside of it. The function 
 * arguments or names might be changed at any time
 * 
 * @internal
 * @package bloge
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
    
    return array_filter($files, '\Bloge\isFileVisible');
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
        
        $file = removeExtension(substr($file, $length));
        
        if (strpos($file, '.') !== 0) {
            $files[] = $file;
        }
    }
    
    return $files;
}

/**
 * @param string $file
 * @return bool
 */
function isFileVisible($file) {
    return strpos($file, '/.') === false; 
}

/**
 * @param string $file
 * @return bool
 */
function hasExtension($file) {
    $name = pathinfo($file, PATHINFO_FILENAME);
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    
    return $name !== '' && $ext !== '';
}

/**
 * @param string $file
 * @return string
 */
function removeExtension($file) {
    $dot = strrpos($file, '.');
    
    return $dot === false || !hasExtension($file)
        ? $file 
        : substr($file, 0, $dot);
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
 * @return array
 */
function renderData($__view__, array $__data__) {
    ob_start();
    extract($__data__);
    
    $data = require $__view__;
    $data = is_array($data) ? $data : [];
    $data['content'] = ob_get_clean();
    
    return $data;
}