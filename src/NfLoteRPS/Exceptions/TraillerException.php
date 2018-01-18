<?php
namespace MatheusHack\NfLoteRPS\Exceptions;

class TraillerException extends \Exception
{
    /**
     * TraillerException constructor.
     * @param null $message
     */
    public function __construct($message = null)
    {
        if(!$message)
            $message = 'Trailler exception';

        return parent::__construct($message);
    }
}