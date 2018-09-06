<?php

namespace Epeiros\Http;

if (!function_exists(__NAMESPACE__ . '\\header')) {
    function header($text, $code = null)
    {
        HeaderTestHelper::setText($text);
        HeaderTestHelper::setCode($code);
    }
}
