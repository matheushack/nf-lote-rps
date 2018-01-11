<?php
namespace MatheusHack\NfeLoteRPS\Factories;

use StdClass;
use MatheusHack\NfeLoteRPS\Requests\LayoutRequest;
use MatheusHack\NfeLoteRPS\Factories\HeaderFactory;
use MatheusHack\NfeLoteRPS\Factories\DetailFactory;
use MatheusHack\NfeLoteRPS\Factories\TraillerFactory;

class NfeFactory
{
    private $rps;

    function __construct()
    {
        $this->rps = new StdClass;
    }

    public function make(LayoutRequest $layoutRequest)
    {
        $this->makeHeader($layoutRequest);
        $this->makeDetail($layoutRequest);
        $this->makeTrailler($layoutRequest);
        return $this->rps;
    }

    private function makeHeader(LayoutRequest $layoutRequest)
    {
        $headerFactory = new HeaderFactory;
        $this->rps->header = $headerFactory->make($layoutRequest);
    }

    private function makeDetail(LayoutRequest $layoutRequest)
    {
        $detailFactory = new DetailFactory;
        $this->rps->detail = $detailFactory->make($layoutRequest);
    }

    private function makeTrailler(LayoutRequest $layoutRequest)
    {
        $traillerFactory = new TraillerFactory;
        $this->rps->trailler = $traillerFactory->make($layoutRequest);
    }     
}
