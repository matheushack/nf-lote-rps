<?php
namespace MatheusHack\NfeLoteRPS\Factories;

use StdClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use MatheusHack\NfeLoteRPS\Requests\LayoutRequest;
use MatheusHack\NfeLoteRPS\Factories\HeaderFactory;
use MatheusHack\NfeLoteRPS\Factories\DetailFactory;
use MatheusHack\NfeLoteRPS\Factories\TraillerFactory;

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
        $timestamp = Carbon::now()->timestamp;
        $file = sys_get_temp_dir()."/#{$timestamp}-{$this->layoutRequest->getTypeNf()}-{$this->layoutRequest->getType()}.txt";
        $content = implode($this->rps->header, '');

        foreach($this->rps->detail as $detail){
            $content .= implode($detail, '');
        }

        $content .= implode($this->rps->trailler, '');

        if(!file_put_contents($file, $content, FILE_TEXT))
            throw new \Exception("Problem generating file");

        return $file;
    }
}
