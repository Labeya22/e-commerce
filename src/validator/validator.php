<?php


function regex(string $data, string $regex) {
    return preg_match($regex, $data);
}

function lenghtMin(string $data, int $min) {
    return strlen($data) < $min;
}

function lenghtMax(string $data, int $max) {
    return strlen($data) > $max;
    
}

function lenghtBetween(string $data, int $min, int $max) {
    $len = strlen($data);
    return $len < $min || $len > $max;
}

function isEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isEqual($k, $v) {
    return $k === $v;
}