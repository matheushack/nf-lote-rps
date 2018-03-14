<?php
namespace MatheusHack\NfLoteRPS\Factories\Remessa;

use MatheusHack\NfLoteRPS\Constants\FieldType;
use MatheusHack\NfLoteRPS\Helpers\Functions;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;

/**
 * Class DetailFactory
 * @package MatheusHack\NfLoteRPS\Factories\Remessa
 */
class DetailFactory
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
            $lineDetail = $line + 1;

            foreach($register as $field => $value){
                $amount = ($layout[$field]['pos'][1] - $layout[$field]['pos'][0]) + 1;

                if(empty($value) && data_get($layout[$field], 'default')){
                    $detail[$line][$field] = $this->functions->convertFieldToType($layout[$field]['default'], $layout[$field]['type'], $amount);
                    continue;                
                }              

                if(empty($value) && $layout[$field]['type'] != FieldType::ENDLINE){
                    $detail[$line][$field] = $this->functions->convertFieldToType('', $layout[$field]['type'], $amount);
                    continue;
                }

                if($layout[$field]['type'] == FieldType::ENDLINE){
                    $detail[$line][$field] = $this->functions->validateFields($layout[$field], '', $field, $amount, "Detail {$lineDetail}");
                    continue;
                }                

                $detail[$line][$field] = $this->functions->validateFields($layout[$field], $value, $field, $amount, "Detail {$lineDetail}");
            }
        }

        return $detail;
    }    

}