<?php

function arr_default(array $arr, string $key, string $default = '')
{
    if ( array_key_exists($key, $arr) ) 
    {
        return $arr[$key];
    }
    return $default;
}

// Returns a _SERVER variable if it exists or the default value
function http_server_var(string $key, string $default = '')
{
    return arr_default($_SERVER, $key, $default);
}

function http_get_var(string $key, string $default = '')
{
    return arr_default($_GET, $key, $default);
}
