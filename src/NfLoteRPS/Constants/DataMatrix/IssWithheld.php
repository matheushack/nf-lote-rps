<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/01/18
 * Time: 15:09
 */

namespace MatheusHack\NfLoteRPS\Constants\DataMatrix;


use MatheusHack\NfLoteRPS\Traits\ConstantsTrait;

/**
 * Class IssWithheld
 * @package MatheusHack\NfLoteRPS\Constants\DataMatrix
 */
class IssWithheld
{
    use ConstantsTrait;

    /**
     *
     */
    const ISS_RETIDO_TOMADOR = 1;

    /**
     *
     */
    const NOTA_FISCAL_SEM_ISS_RETIDO = 2;

    /**
     *
     */
    const ISS_RETIDO_INTERMEDIARIO = 3;

}