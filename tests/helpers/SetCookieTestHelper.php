<?php

namespace Epeiros\Http;

class SetCookieTestHelper
{
    private static $oldText;

    private static $oldValue;

    private static $text;

    private static $value;

    public static function setName($text)
    {
        self::$oldText = self::$text;
        self::$text    = $text;
    }

    public static function getName()
    {
        return self::$text;
    }

    public static function getOldName()
    {
        return self::$oldText;
    }

    public static function setValue($value)
    {
        self::$oldValue = self::$value;
        self::$value    = $value;
    }

    public static function getValue()
    {
        return self::$value;
    }

    public static function getOldValue()
    {
        return self::$oldValue;
    }

    public static function reset()
    {
        self::$text == null;
        self::$value == null;
        self::$oldText == null;
        self::$oldValue == null;
    }
}
