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

class HeaderFactory
{

    public function make(LayoutRequest $layoutRequest)
    {
        $header = new \stdClass();
        $layout = $layoutRequest->getLayoutHeader();
        $data = $layoutRequest->getFileHeader();

        foreach($layout as $field => $parameters){
            if($parameters['type'] == FieldType::NOT_FILL)
                $amount = $parameters['maximum'];
            else
                $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;

            $valueFile = substr($data, $parameters['pos'][0] - 1, $amount);
            $header->$field = treatFieldToType($valueFile, $parameters['type']);
        }

        return $header;
    }

}