<?php

namespace Bloge;

/**
 * array_filter wrapper
 * 
 * @param callable $callback
 * @return callable
 */
function filter (callable $callback) {
    return function (array $data) use ($callback) {
        return array_filter($data, $callback);
    };
}

/**
 * array_mapper wrapper
 * 
 * @param callable $callback
 * @return callable
 */
function map (callable $callback) {
    return function (array $data) use ($callback) {
        return array_map($callback, $data);
    };
}

/**
 * Inject value into content
 * 
 * @param string $key
 * @param mixed $value
 * @return callable
 */
function inject ($key, $value) {
    return function ($_, $data) use ($key, $value) {
        $data[$key] = $value;
        
        return $data;
    };
}