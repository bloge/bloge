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

    $content = array_values(
        array_map('strval', iterator_to_array($iterator))
    );
}