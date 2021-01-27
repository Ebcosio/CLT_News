<?php
defined('ABSPATH') || die;

require_once CLT_EVENTS_DIR . 'inc/utils/array.php';
require_once CLT_EVENTS_DIR . 'inc/utils/date.php';

function clt_plain_text_excerpt($str, $word_limit = 45) {
    $str = strip_tags($str);
    $arr = explode(' ', $str, $word_limit);
    $arr[count($arr) - 1] = ''; // With $word_limit, explode leaves the rest of the string in the last element
    $str = implode(' ', $arr);
    return $str . '. . .';
}
