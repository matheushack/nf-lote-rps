<?php
namespace MatheusHack\NfLoteRPS\Exceptions;

/**
 * Class ValidateException
 * @package MatheusHack\NfLoteRPS\Exceptions
 */
class ValidateException extends \Exception
{
    /**
     * ValidateException constructor.
     * @param null $message
     */
    public function __construct($message = null)
    {
        if(!$message)
            $message = 'Validate exception';

        return parent::__construct($message);
    }
}