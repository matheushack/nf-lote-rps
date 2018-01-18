<?php

namespace MatheusHack\NfLoteRPS\Constants;

class FieldType
{
    const TEXT = 'text';
    const DATE = 'date';
    const MONEY = 'money';
    const WHITE = 'white';
    const NUMBER = 'number';
    const ENDLINE = 'endline';
    const NOT_FILL = 'notFill';
    const DATETIME = 'datetime';
    const CHARACTER = 'character';
    const PERCENTAGE = 'percentage';

    public static function arrayAllowed()
    {
        return [
            self::TEXT,
            self::DATE,
            self::MONEY,
            self::WHITE,
            self::NUMBER,
            self::ENDLINE,
            self::NOT_FILL,
            self::DATETIME,
            self::CHARACTER,
            self::PERCENTAGE,
        ];
    }

}
