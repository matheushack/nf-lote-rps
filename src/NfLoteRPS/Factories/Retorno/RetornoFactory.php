<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/01/18
 * Time: 11:44
 */

namespace MatheusHack\NfLoteRPS\Factories\Retorno;


use MatheusHack\NfLoteRPS\Entities\DataFile;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;

class RetornoFactory
{

    private $layoutRequest;

    private $dataFile;

    function __construct(LayoutRequest $layoutRequest)
    {
        $this->layoutRequest = $layoutRequest;
        $this->dataFile = new DataFile();
    }

    public function make()
    {
        $this->makeHeader();
        $this->makeDetail();
        $this->makeTrailler();

        return $this->dataFile;
    }

    private function makeHeader()
    {
        $header = new HeaderFactory();
        $this->dataFile->header = $header->make($this->layoutRequest);
    }

    private function makeDetail()
    {
        $detail = new DetailFactory();
        $this->dataFile->detail = $detail->make($this->layoutRequest);
    }

    private function makeTrailler()
    {
        $trailler = new TraillerFactory();
        $this->dataFile->trailler = $trailler->make($this->layoutRequest);
    }
}