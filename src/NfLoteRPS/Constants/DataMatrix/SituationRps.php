<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/01/18
 * Time: 15:03
 */

namespace MatheusHack\NfLoteRPS\Constants\DataMatrix;


use MatheusHack\NfLoteRPS\Traits\ConstantsTrait;

/**
 * Class SituationRps
 * @package MatheusHack\NfLoteRPS\Constants\DataMatrix
 */
class SituationRps
{
    use ConstantsTrait;

    /**
     *
     */
    const TRIBUTADO_SAO_PAULO = 'T';

    /**
     *
     */
    const TRIBUTADO_FORA_SAO_PAULO = 'F';

    /**
     *
     */
    const TRIBUTADO_SAO_PAULO_ISENTO = 'A';

    /**
     *
     */
    const TRIBUTADO_FORA_SAO_PAULO_ISENTO = 'B';

    /**
     *
     */
    const TRIBUTADO_SAO_PAULO_IMUNE = 'M';

    /**
     *
     */
    const TRIBUTADO_FORA_SAO_PAULO_IMUNE = 'N';

    /**
     *
     */
    const TRIBUTADO_SAO_PAULO_EXGIBILIDADE_SUSPENSA = 'X';

    /**
     *
     */
    const TRIBUTADO_FORA_SAO_PAULO_EXGIBILIDADE_SUSPENSA = 'V';

    /**
     *
     */
    const EXPORTACAO_SERVICOS = 'P';

    /**
     *
     */
    const CANCELADO = 'C';

}