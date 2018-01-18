<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/01/18
 * Time: 11:51
 */

namespace MatheusHack\NfLoteRPS\Factories\Retorno;


use MatheusHack\NfLoteRPS\Constants\FieldType;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;

/**
 * Class TraillerFactory
 * @package MatheusHack\NfLoteRPS\Factories\Retorno
 */
class TraillerFactory
{
    /**
     * @param LayoutRequest $layoutRequest
     * @return \stdClass
     */
    public function make(LayoutRequest $layoutRequest)
    {
        $trailler = new \stdClass();
        $layout = $layoutRequest->getLayoutTrailler();
        $data = $layoutRequest->getFileTrailler();

        foreach($layout as $field => $parameters){
            if($parameters['type'] == FieldType::NOT_FILL)
                $amount = $parameters['maximum'];
            else
                $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;

            $valueFile = substr($data, $parameters['pos'][0] - 1, $amount);
            $trailler->$field = treatFieldToType($valueFile, $parameters['type']);
        }

        return $trailler;
    }
}