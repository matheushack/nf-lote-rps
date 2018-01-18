<?php
namespace MatheusHack\NfLoteRPS\Exceptions;

/**
 * Class LayoutException
 * @package MatheusHack\NfLoteRPS\Exceptions
 */
class LayoutException extends \Exception
{
    /**
     * LayoutException constructor.
     * @param null $message
     */
    public function __construct($message = null)
    {
        if(!$message)
            $message = 'Layout exception';

        return parent::__construct($message);
    }
}