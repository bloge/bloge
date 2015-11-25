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
        
        $files[] = substr($file, $length);
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
 * @param string $path
 * @param string $ext
 * @return string
 */
function replaceExtension($path, $ext) {
    extract(pathinfo($path));
    
    $dirname = $dirname === '.' ? '' : $dirname;
    
    return ltrim("$dirname/$filename.$ext", '/');
}

/**
 * @param string $path
 * @param string $basepath
 */
function expandPath($path, $basepath = '')
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
 * @param array $data
 * @param callable $callback
 */
function array_map($data, callable $callback) {
    return \array_map($callback, $data);
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