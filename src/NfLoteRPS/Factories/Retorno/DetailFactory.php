<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/01/18
 * Time: 11:51
 */

namespace MatheusHack\NfLoteRPS\Factories\Retorno;


use Illuminate\Support\Collection;
use MatheusHack\NfLoteRPS\Constants\FieldType;
use MatheusHack\NfLoteRPS\Helpers\Functions;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;

/**
 * Class DetailFactory
 * @package MatheusHack\NfLarrayAllowedoteRPS\Factories\Retorno
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
     * @return Collection
     */
    public function make(LayoutRequest $layoutRequest)
    {
        $details = [];
        $layout = $layoutRequest->getLayoutDetail();
        $data = $layoutRequest->getFileDetails();

        foreach($data as $key => $detail) {
            $stdClass = new \stdClass();

            foreach ($layout as $field => $parameters) {
                if ($parameters['type'] == FieldType::NOT_FILL)
                    $amount = $parameters['maximum'];
                else
                    $amount = ($parameters['pos'][1] - $parameters['pos'][0]) + 1;

                $valueFile = substr($detail, $parameters['pos'][0] - 1, $amount);
                $stdClass->$field = $this->functions->treatFieldToType($valueFile, $parameters['type'], $key);
            }

            $details[$key] = $stdClass;
        }

        return new Collection($details);
    }
}