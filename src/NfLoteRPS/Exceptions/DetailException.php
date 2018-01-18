<?php
namespace MatheusHack\NfLoteRPS\Exceptions;

/**
 * Class DetailException
 * @package MatheusHack\NfLoteRPS\Exceptions
 */
class DetailException extends \Exception
{
    /**
     * DetailException constructor.
     * @param null $message
     */
    public function __construct($message = null)
    {
        if(!$message)
            $message = 'Detail exception';

        return parent::__construct($message);
    }
}