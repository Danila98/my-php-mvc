<?php
ini_set('dsplay_errors', 1);
error_reporting(E_ALL);

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    exit;
}