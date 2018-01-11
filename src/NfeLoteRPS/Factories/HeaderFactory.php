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
            if(!isset($newData[$field]) && data_get($parameters, 'default')){
                $header[$field] = $parameters['default'];
                continue;                
            }

            if(data_get($parameters, 'required') && boolval(data_get($parameters, 'required')) === true && ((!isset($newData[$field]) || empty($newData[$field]))) && $parameters['type'] != FieldType::ENDLINE)
                throw new HeaderException("The {$field} field is mandatory and does not have a default value");

            switch($parameters['type']){
                default:
                case FieldType::TEXT: 
                    $header[$field] = treatText($newData[$field]);
                break;
                case FieldType::NUMBER: 
                    if(!validateNumeric($newData[$field]))
                        throw new HeaderException("The default value of the {$field} field must be a number");
                        
                    $header[$field] = $newData[$field];
                break;
                case FieldType::DATE: 
                    if(!validateDate($newData[$field], 'Ymd'))
                        throw new HeaderException("The default value of the {$field} field must be filled in the date format (YYYYMMDD)");

                    $header[$field] = $newData[$field];
                break;
                case FieldType::CHARACTER: 
                    if(!validateCharacter($data[$field]))
                        throw new HeaderException("The default {$field} field value must be a character");

                    $header[$field] = treatText($newData[$field]);
                break;
                case FieldType::ENDLINE:
                    $header[$field] = chr(13).chr(10);
                    continue;
                break;
            }

            $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;
            $header[$field] = convertFieldToType($header[$field], $parameters['type'], $amount);
        }

        return $header;
    }    

}