<?php
namespace MatheusHack\NfLoteRPS\Factories\Remessa;

use MatheusHack\NfLoteRPS\Constants\FieldType;
use MatheusHack\NfLoteRPS\Helpers\Functions;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;

/**
 * Class TraillerFactory
 * @package MatheusHack\NfLoteRPS\Factories\Remessa
 */
class TraillerFactory
{
    /**
     * @var Functions
     */
    private $functions;

    /**
     * DetailFactory constructor.
     */
    function __construct()
    {
        $this->functions = new Functions();
    }

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
                $trailler[$field] = $this->functions->convertFieldToType('', $parameters['type'], $amount);
                continue;
            }

            if($parameters['type'] == FieldType::ENDLINE){
                $trailler[$field] = $this->functions->validateFields($parameters, '', $field, $amount, 'Trailler');
                continue;
            }              

            $trailler[$field] = $this->functions->validateFields($parameters, $newData[$field], $field, $amount, 'Trailler');
        }

        return $trailler;
    }    

}