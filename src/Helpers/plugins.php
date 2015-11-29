<?php

namespace Bloge;

/**
 * @param string $field
 * @param callable $callback
 * @return callable
 */
function process($field, callable $callback) {
    return function ($_, $data) use ($field, $callback) {
        $data[$field] = $callback($data[$field]);
        
        return $data;
    };
}

/**
 * @param string $field
 * @param callable $callback
 * @return callable
 */
function processMerge($field, callable $callback) {
    return function ($_, $data) use ($field, $callback) {
        return array_merge($data, $callback($data[$field]));
    };
}

/**
 * @param string $regex
 * @return callable
 */
function rFilter($regex) {
    return function ($value) use ($regex) {
        return preg_match($regex, $value);
    };
}