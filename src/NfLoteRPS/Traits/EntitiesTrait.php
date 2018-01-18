<?php
namespace MatheusHack\NfLoteRPS\Traits;

/**
 * Trait EntitiesTrait
 * @package MatheusHack\NfLoteRPS\Traits
 */
trait EntitiesTrait
{
    /**
     * @return array
     */
    public function toArray()
    {
        return (array) get_object_vars($this);
    }
}