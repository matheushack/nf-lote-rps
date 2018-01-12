<?php
namespace MatheusHack\NfLoteRPS\Traits;

trait EntitiesHelper
{
    public function toArray()
    {
        return (array) get_object_vars($this);
    }
}