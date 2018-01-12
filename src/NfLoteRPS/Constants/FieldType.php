<?php

namespace MatheusHack\NfeLoteRPS\Constants;

class FieldType
{
    const TEXT = 'text';
    const DATE = 'date';
    const MONEY = 'money';
    const WHITE = 'white';
    const NUMBER = 'number';
    const ENDLINE = 'endline';
    const NOT_FILL = 'notFill';
    const CHARACTER = 'character';

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
            self::CHARACTER,
        ];
    }

}
