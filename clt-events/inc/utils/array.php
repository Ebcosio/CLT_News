<?php

/**
 * Checks if a deep property exists in an array
 * @param array $array Must be an array.
 * @param array $key_array Contains the 
 */
function clt_array_key_path_exists($array, $key_array)
{
    $key = array_shift($key_array);
    if (count($key_array) > 0) {
        if (is_array($array[$key]) ) {
            return clt_array_key_path_exists($array[$key], $key_array); // Note: $key_array has already been shifted
        }
    } else {
        if ( array_key_exists($key, $array) ) {
            return true;
        }
    }
    return false;
}

