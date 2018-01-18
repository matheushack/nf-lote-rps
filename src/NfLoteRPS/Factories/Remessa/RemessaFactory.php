<?php
namespace MatheusHack\NfLoteRPS\Factories\Remessa;

use StdClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;

/**
 * Class RemessaFactory
 * @package MatheusHack\NfLoteRPS\Factories\Remessa
 */
class RemessaFactory
{
    /**
     * @var StdClass
     */
    private $rps;

    /**
     * @var LayoutRequest
     */
    private $layoutRequest;

    /**
     * RemessaFactory constructor.
     * @param LayoutRequest $layoutRequest
     */
    function __construct(LayoutRequest $layoutRequest)
    {
        $this->rps = new StdClass;
        $this->layoutRequest = $layoutRequest;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function make()
    {
        $this->makeHeader();
        $this->makeDetail();
        $this->makeTrailler();

        return $this->save();
    }

    /**
     * @throws \MatheusHack\NfLoteRPS\Exceptions\ValidateException
     */
    private function makeHeader()
    {
        $headerFactory = new HeaderFactory;
        $this->rps->header = $headerFactory->make($this->layoutRequest);
    }

    /**
     * @throws \MatheusHack\NfLoteRPS\Exceptions\ValidateException
     */
    private function makeDetail()
    {
        $detailFactory = new DetailFactory;
        $this->rps->detail = $detailFactory->make($this->layoutRequest);
    }

    /**
     *
     */
    private function makeTrailler()
    {
        $traillerFactory = new TraillerFactory;
        $this->rps->trailler = $traillerFactory->make($this->layoutRequest);
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function save()
    {
         $timestamp = Carbon::now()->timestamp;
        $file = "{$this->layoutRequest->getPathSaveFile()}/#{$timestamp}-{$this->layoutRequest->getTypeNf()}-{$this->layoutRequest->getType()}.txt";
        $content = implode('', $this->rps->header);

        foreach($this->rps->detail as $detail){
            $content .= implode('', $detail);
        }

        $content .= implode('', $this->rps->trailler);

        if(!file_put_contents($file, $content, FILE_TEXT))
            throw new \Exception("Problem generating file");

        return $file;
    }
}
