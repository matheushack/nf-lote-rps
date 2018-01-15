<?php
namespace MatheusHack\NfLoteRPS\Factories;

use StdClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;
use MatheusHack\NfLoteRPS\Factories\HeaderFactory;
use MatheusHack\NfLoteRPS\Factories\DetailFactory;
use MatheusHack\NfLoteRPS\Factories\TraillerFactory;

class NfeFactory
{
    private $rps;

    private $layoutRequest;

    function __construct(LayoutRequest $layoutRequest)
    {
        $this->rps = new StdClass;
        $this->layoutRequest = $layoutRequest;
    }

    public function make()
    {
        $this->makeHeader();
        $this->makeDetail();
        $this->makeTrailler();

        // dd($this->rps);

        return $this->save();
    }

    private function makeHeader()
    {
        $headerFactory = new HeaderFactory;
        $this->rps->header = $headerFactory->make($this->layoutRequest);
    }

    private function makeDetail()
    {
        $detailFactory = new DetailFactory;
        $this->rps->detail = $detailFactory->make($this->layoutRequest);
    }

    private function makeTrailler()
    {
        $traillerFactory = new TraillerFactory;
        $this->rps->trailler = $traillerFactory->make($this->layoutRequest);
    }     

    private function save()
    {
        // $timestamp = Carbon::now()->timestamp;
        $timestamp = '1516014517';
        $file = "{$this->layoutRequest->getPathSaveFile()}/#{$timestamp}-{$this->layoutRequest->getTypeNf()}-{$this->layoutRequest->getType()}.txt";
        $content = implode('', $this->rps->header);

        foreach($this->rps->detail as $detail){
            $content .= implode('', $detail);
        }

        $content .= implode('', $this->rps->trailler);

        // return $content;

        if(!file_put_contents($file, $content, FILE_TEXT))
            throw new \Exception("Problem generating file");

        return $file;
    }
}
