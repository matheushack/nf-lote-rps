<?php

namespace MatheusHack\NfeLoteRPS\Factories;

use MatheusHack\NfeLoteRPS\Constants\FieldType;
use MatheusHack\NfeLoteRPS\Requests\LayoutRequest;
use MatheusHack\NfeLoteRPS\Exceptions\HeaderException;


class NfeFactory
{
    private $rps;

    public function make(LayoutRequest $layoutRequest)
    {
        return $this->makeHeader($layoutRequest);
    }

    private function makeHeader(LayoutRequest $layoutRequest)
    {
        $header = [];
        $layout = $layoutRequest->getHeader();
        $data = $layoutRequest->getDataHeader();

        $fields = array_keys($layout);
        // dd($fields);

        foreach($layout as $field => $parameters){
            dd($field, $parameters);
            if(isset($parameters['required']) && boolval($parameters['required']) === true){
                 if(!isset($parameters['default']) && isset($data[$field]) && empty($data[$field]))
                    throw new LayoutException("Layout {$file} of type {$this->type} not found for version {$this->layout}");

                if(isset($data[$field]) && empty($data[$field]))
                    $header[$field] = $parameters['default'];
                else
                    $header[$field] = $parameters['default'];
            }

            if(isset($data[$field]) && empty($data[$field])){
                $header[$field] = $parameters['default'];
                continue;
            }


            if(!array_key_exists($field, $fields))
                continue;

            dd($data, $field, $header);            

            switch($parameters['type']){
                default:
                case FieldType::TEXT: 
                    $header[$field] = $data[$field];
                break;
                case FieldType::NUMBER: 
                    if(!validateNumeric($data[$field]))
                        throw new LayoutException("The default value of the {$field} field must be a number");
                        
                    $header[$field] = $data[$field];
                break;
                case FieldType::DATE: 
                    if(!validateDate($data[$field], 'Ymd'))
                        throw new LayoutException("The default value of the {$field} field must be filled in the date format (YYYYMMDD)");

                    $header[$field] = $data[$field];
                break;
                case FieldType::CHARACTER: 
                    if(!validateCharacter($data[$field]))
                        throw new LayoutException("The default {$field} field value must be a character");

                    $header[$field] = $data[$field];
                break;
                case FieldType::ENDLINE:
                    $header[$field] = chr(10).chr(13);
                break;
            }                

            echo '<pre>';var_dump($header);exit;
        }


        echo '<pre>';var_dump($data);exit;
    }
}
