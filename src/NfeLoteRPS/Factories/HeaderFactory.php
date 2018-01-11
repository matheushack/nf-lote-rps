<?php
namespace MatheusHack\NfeLoteRPS\Factories;

use MatheusHack\NfeLoteRPS\Constants\FieldType;
use MatheusHack\NfeLoteRPS\Requests\LayoutRequest;
use MatheusHack\NfeLoteRPS\Exceptions\HeaderException;

class HeaderFactory
{

    public function make(LayoutRequest $layoutRequest)
    {
        $header = [];
        $newData = [];
        $layout = $layoutRequest->getHeader();
        $data = $layoutRequest->getDataHeader();

        foreach($data as $field => $value){
            if(!array_key_exists($field, $layout))
                continue;

            $newData[$field] = $data[$field];
        }

        foreach($layout as $field => $parameters){
            $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;
            
            if(!isset($newData[$field]) && data_get($parameters, 'default')){
                $header[$field] = $parameters['default'];
                continue;                
            }

            if(((!isset($newData[$field]) || empty($newData[$field]))) && $parameters['type'] != FieldType::ENDLINE){
                $header[$field] = convertFieldToType('', $parameters['type'], $amount);
                continue;
            }

            if($parameters['type'] == FieldType::ENDLINE){
                $header[$field] = validateFields($parameters, '', $field, $amount);
                continue;
            }

            $header[$field] = validateFields($parameters, $newData[$field], $field, $amount);
        }

        return $header;
    }    

}