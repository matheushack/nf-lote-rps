<?php
namespace MatheusHack\NfeLoteRPS\Factories;

use MatheusHack\NfeLoteRPS\Constants\FieldType;
use MatheusHack\NfeLoteRPS\Requests\LayoutRequest;
use MatheusHack\NfeLoteRPS\Exceptions\TraillerException;

class TraillerFactory
{

    public function make(LayoutRequest $layoutRequest)
    {
        $trailler = [];
        $newData = [];
        $layout = $layoutRequest->getTrailler();
        $data = $layoutRequest->getDataTrailler();

        foreach($data as $field => $value){
            if(!array_key_exists($field, $layout))
                continue;

            $newData[$field] = $data[$field];
        }

        foreach($layout as $field => $parameters){
            $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;

            if(!isset($newData[$field]) && data_get($parameters, 'default')){
                $trailler[$field] = $parameters['default'];
                continue;                
            }

            if(((!isset($newData[$field]) || empty($newData[$field]))) && $parameters['type'] != FieldType::ENDLINE){
                $trailler[$field] = convertFieldToType('', $parameters['type'], $amount);
                continue;
            }

            if($parameters['type'] == FieldType::ENDLINE){
                $trailler[$field] = validateFields($parameters, '', $field, $amount);
                continue;
            }            

            $trailler[$field] = validateFields($parameters, $newData[$field], $field, $amount);
        }

        return $trailler;
    }    

}