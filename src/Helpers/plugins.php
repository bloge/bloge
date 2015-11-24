<?php

function filter (callable $callback) {
    return function (array $data) use ($callback) {
        return array_filter($data, $callback);
    };
}

function map (callable $callback) {
    return function (array $data) use ($callback) {
        return array_map($callback, $data);
    };
}

function inject ($key, $value) {
    return function ($_, $data) use ($key, $value) {
        $data[$key] = $value;
        
        return $data;
    };
}