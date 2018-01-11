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
            if(!isset($newData[$field]) && data_get($parameters, 'default')){
                $trailler[$field] = $parameters['default'];
                continue;                
            }

            if(data_get($parameters, 'required') && boolval(data_get($parameters, 'required')) === true && ((!isset($newData[$field]) || empty($newData[$field]))) && $parameters['type'] != FieldType::ENDLINE)
                throw new TraillerException("The {$field} field is mandatory and does not have a default value");

            switch($parameters['type']){
                default:
                case FieldType::TEXT: 
                    $trailler[$field] = $newData[$field];
                break;
                case FieldType::NUMBER: 
                    if(!validateNumeric($newData[$field]))
                        throw new TraillerException("The default value of the {$field} field must be a number");
                        
                    $trailler[$field] = $newData[$field];
                break;
                case FieldType::DATE: 
                    if(!validateDate($newData[$field], 'Ymd'))
                        throw new TraillerException("The default value of the {$field} field must be filled in the date format (YYYYMMDD)");

                    $trailler[$field] = $newData[$field];
                break;
                case FieldType::CHARACTER: 
                    if(!validateCharacter($newData[$field]))
                        throw new TraillerException("The default {$field} field value must be a character");

                    $trailler[$field] = $newData[$field];
                break;
                case FieldType::ENDLINE:
                    $trailler[$field] = chr(13).chr(10);
                break;
            }

            $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;
            $trailler[$field] = convertFieldToType($trailler[$field], $parameters['type'], $amount);                            
        }

        return $trailler;
    }    

}