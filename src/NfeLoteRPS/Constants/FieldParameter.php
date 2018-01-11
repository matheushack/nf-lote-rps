<?php

namespace MatheusHack\NfeLoteRPS\Constants;

class FieldParameter
{
    const POS = 'pos';
    const TYPE = 'type';
    const DEFAULT = 'default';
    const MAXIMUM = 'maximum';

    public static function arrayAllowed()
    {
        return [
            self::POS,
            self::TYPE,
            self::DEFAULT,
            self::MAXIMUM,
        ];
    }

}
