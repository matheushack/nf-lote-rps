<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/01/18
 * Time: 14:52
 */

namespace MatheusHack\NfLoteRPS\Traits;


/**
 * Trait ConstantsTrait
 * @package MatheusHack\NfLoteRPS\Traits
 */
trait ConstantsTrait
{

    /**
     * @return array
     */
    public static function arrayAllowed()
    {
        $reflection = new \ReflectionClass(self::class);
        return $reflection->getConstants();
    }
}