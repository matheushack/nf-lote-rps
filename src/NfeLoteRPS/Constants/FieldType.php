<?php

namespace NfeLoteRPS\Constants;

class FieldType
{
    const TEXT = 'text';
    const DATE = 'date';
    const NUMBER = 'number';
    const ENDLINE = 'endline';
    const CHARACTER = 'character';

    public static function arrayAllowed()
    {
        return [
            self::TEXT,
            self::DATE,
            self::NUMBER,
            self::ENDLINE,
            self::CHARACTER,
        ];
    }

}
