<?php

namespace Epeiros\Http;

class HeaderTestHelper
{
    private static $text;
    private static $code;

    public static function setText($text)
    {
        self::$text = $text;
    }

    public static function getText()
    {
        return self::$text;
    }

    public static function setCode($code)
    {
        self::$code = $code;
    }

    public static function getCode()
    {
        return self::$code;
    }

    public static function reset()
    {
        self::$text == null;
        self::$code == null;
    }
}
