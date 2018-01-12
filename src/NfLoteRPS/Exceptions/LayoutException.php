<?php
namespace MatheusHack\NfeLoteRPS\Exceptions;

class LayoutException extends \Exception
{
    public function __construct($message = null)
    {
        if(!$message)
            $message = '';

        return parent::__construct($message);
    }
}