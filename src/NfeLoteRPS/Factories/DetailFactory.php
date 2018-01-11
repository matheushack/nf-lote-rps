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
                if(!isset($newData[$line][$field]) && data_get($parameters, 'default')){
                    $detail[$line][$field] = $parameters['default'];
                    continue;                
                }

                if(data_get($parameters, 'required') && boolval(data_get($parameters, 'required')) === true && ((!isset($newData[$line][$field]) || empty($newData[$line][$field]))) && $parameters['type'] != FieldType::ENDLINE)
                    throw new DetailException("The {$field} field is mandatory and does not have a default value");

                switch($parameters['type']){
                    default:
                    case FieldType::TEXT: 
                        $detail[$line][$field] = $newData[$line][$field];
                    break;
                    case FieldType::NUMBER: 
                        if(!validateNumeric($newData[$line][$field]))
                            throw new DetailException("The default value of the {$field} field must be a number");
                            
                        $detail[$line][$field] = $newData[$line][$field];
                    break;
                    case FieldType::DATE: 
                        if(!validateDate($newData[$line][$field], 'Ymd'))
                            throw new DetailException("The default value of the {$field} field must be filled in the date format (YYYYMMDD)");

                        $detail[$line][$field] = $newData[$line][$field];
                    break;
                    case FieldType::CHARACTER:
                        if(!validateCharacter($newData[$line][$field]))
                            throw new DetailException("The default {$field} field value must be a character");

                        $detail[$line][$field] = $newData[$line][$field];
                    break;
                    case FieldType::ENDLINE:
                        $detail[$line][$field] = chr(13).chr(10);
                    break;
                }

                $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;
                $detail[$line][$field] = convertFieldToType($detail[$line][$field], $parameters['type'], $amount);                
            }
        }

        return $detail;
    }    

}