<?php
namespace MatheusHack\NfLoteRPS\Factories\Remessa;

use MatheusHack\NfLoteRPS\Constants\FieldType;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;
use MatheusHack\NfLoteRPS\Exceptions\TraillerException;

/**
 * Class TraillerFactory
 * @package MatheusHack\NfLoteRPS\Factories\Remessa
 */
class TraillerFactory
{
    /**
     * @param LayoutRequest $layoutRequest
     * @return array
     * @throws \MatheusHack\NfLoteRPS\Exceptions\ValidateException
     */
    public function make(LayoutRequest $layoutRequest)
    {
        $trailler = [];
        $newData = [];
        $layout = $layoutRequest->getLayoutTrailler();
        $data = $layoutRequest->getDataTrailler();

        foreach($data as $field => $value){
            if(!array_key_exists($field, $layout))
                continue;

            $newData[$field] = $data[$field];
        }

        foreach($layout as $field => $parameters){
            $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;

            if(empty($newData[$field]) && data_get($parameters, 'default')){
                $trailler[$field] = $parameters['default'];
                continue;                
            }              

            if(empty($newData[$field]) && $parameters['type'] != FieldType::ENDLINE){
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