<?php
namespace MatheusHack\NfLoteRPS\Exceptions;

/**
 * Class HeaderException
 * @package MatheusHack\NfLoteRPS\Exceptions
 */
class HeaderException extends \Exception
{
    /**
     * HeaderException constructor.
     * @param null $message
     */
    public function __construct($message = null)
    {
        if(!$message)
            $message = 'Header exception';

        return parent::__construct($message);
    }
}