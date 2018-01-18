<?php
namespace MatheusHack\NfLoteRPS\Factories\Remessa;

use MatheusHack\NfLoteRPS\Constants\FieldType;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;
use MatheusHack\NfLoteRPS\Exceptions\DetailException;

class DetailFactory
{
    public function make(LayoutRequest $layoutRequest)
    {
        $detail = [];
        $newData = [];
        $layout = $layoutRequest->getLayoutDetail();
        $data = $layoutRequest->getDataDetail();

        foreach($data as $line => $register){
            $detailArray = $register->toArray();

            foreach($layout as $fieldLayout => $optionsLayout){
                if(array_key_exists($fieldLayout, $detailArray))
                    $newData[$line][$fieldLayout] = $detailArray[$fieldLayout];
                else
                    $newData[$line][$fieldLayout] = '';
            }
        }

        foreach($newData as $line => $register){
            foreach($register as $field => $value){
                $amount = ($layout[$field]['pos'][1] - $layout[$field]['pos'][0]) + 1;

                if(empty($value) && data_get($layout[$field], 'default')){
                    $detail[$line][$field] = convertFieldToType($layout[$field]['default'], $layout[$field]['type'], $amount);
                    continue;                
                }              

                if(empty($value) && $layout[$field]['type'] != FieldType::ENDLINE){
                    $detail[$line][$field] = convertFieldToType('', $layout[$field]['type'], $amount);
                    continue;
                }

                if($layout[$field]['type'] == FieldType::ENDLINE){
                    $detail[$line][$field] = validateFields($layout[$field], '', $field, $amount);
                    continue;
                }                

                $detail[$line][$field] = validateFields($layout[$field], $value, $field, $amount);
            }
        }

        return $detail;
    }    

}