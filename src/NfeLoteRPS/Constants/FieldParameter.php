<?php

namespace NfeLoteRPS\Constants;

class FieldParameter
{
    const POS = 'pos';
    const TYPE = 'type';
    const DEFAULT = 'default';
    const REQUIRED = 'required';

    public static function arrayAllowed()
    {
        return [
            self::POS,
            self::TYPE,
            self::DEFAULT,
            self::REQUIRED,
        ];
    }

}
