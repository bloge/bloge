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
 * @param mixed $value
 * @param mixed $default
 * @return callable
 */
function rFilter($regex, $value = null, $default = false) {
    if ($value === null) {
        return function ($value) use ($regex) {
            return preg_match($regex, $value);
        };
    }
    else {
        return function ($v) use ($regex, $value, $default) {
            return preg_match($regex, $value) ? $value : $default;
        };
    }
}