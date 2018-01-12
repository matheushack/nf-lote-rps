<?php
namespace MatheusHack\NfLoteRPS\Exceptions;

class DetailException extends \Exception
{
    public function __construct($message = null)
    {
        if(!$message)
            $message = '';

        return parent::__construct($message);
    }
}