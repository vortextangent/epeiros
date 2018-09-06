<?php

namespace Epeiros\Http;

if (!function_exists(__NAMESPACE__ . '\\setcookie')) {
    function setcookie(
        $name,
        $value
    ) {
        if (!isset($count)) {
            $count = 1;
        } else {
            $count++;
        }
        if ($count == 2) {
            echo "SETCOOKIE";
            exit();
        }

        SetCookieTestHelper::setName($name);
        SetCookieTestHelper::setValue($value);
    }
}
