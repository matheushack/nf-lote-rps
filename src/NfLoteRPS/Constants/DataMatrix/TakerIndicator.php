<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/01/18
 * Time: 15:11
 */

namespace MatheusHack\NfLoteRPS\Constants\DataMatrix;


use MatheusHack\NfLoteRPS\Traits\ConstantsTrait;

/**
 * Class TakerIndicator
 * @package MatheusHack\NfLoteRPS\Constants\DataMatrix
 */
class TakerIndicator
{
    use ConstantsTrait;

    /**
     *
     */
    const CPF = 1;

    /**
     *
     */
    const CNPJ = 2;

    /**
     *
     */
    const NAO_INFORMADO = 3;
}