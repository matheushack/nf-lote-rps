<?php
namespace MatheusHack\NfeLoteRPS\Factories;

use MatheusHack\NfeLoteRPS\Constants\FieldType;
use MatheusHack\NfeLoteRPS\Requests\LayoutRequest;
use MatheusHack\NfeLoteRPS\Exceptions\DetailException;

class DetailFactory
{

    public function make(LayoutRequest $layoutRequest)
    {
        $detail = [];
        $newData = [];
        $layout = $layoutRequest->getDetail();
        $data = $layoutRequest->getDataDetail();

        foreach($data as $line => $register){
            foreach($register as $field => $value){
                if(!array_key_exists($field, $layout))
                    continue;

                $newData[$line][$field] = $data[$line][$field];
            }
        }

        foreach($newData as $line => $register){
            foreach($layout as $field => $parameters){
                $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;

                if(!isset($newData[$line][$field]) && data_get($parameters, 'default')){
                    $detail[$line][$field] = $parameters['default'];
                    continue;                
                }              

                if(((!isset($newData[$line][$field]) || empty($newData[$line][$field]))) && $parameters['type'] != FieldType::ENDLINE){
                     $detail[$line][$field] = convertFieldToType('', $parameters['type'], $amount);
                    continue;
                }

                if($parameters['type'] == FieldType::ENDLINE){
                    $detail[$line][$field] = validateFields($parameters, '', $field, $amount);
                    continue;
                }                

                $detail[$line][$field] = validateFields($parameters, $newData[$line][$field], $field, $amount);
            }
        }

        return $detail;
    }    

}