<?php

/**
 * array_filter wrapper for \Bloge\Creator::filter
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
 * array_mapper wrapper for \Bloge\Creator::filter
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
 * Inject value into content (\Bloge\Creator::process)
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