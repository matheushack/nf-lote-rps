<?php
namespace MatheusHack\NfeLoteRPS\Exceptions;

class HeaderException extends \Exception
{
    public function __construct($message = null)
    {
        if(!$message)
            $message = '';

        return parent::__construct($message);
    }
}