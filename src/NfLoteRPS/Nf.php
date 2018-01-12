<?php

namespace MatheusHack\NfLoteRPS;

use MatheusHack\NfLoteRPS\Entities\Config;
use MatheusHack\NfLoteRPS\Constants\NfType;
use MatheusHack\NfLoteRPS\Entities\DataFile;
use MatheusHack\NfLoteRPS\Factories\NfeFactory;
use MatheusHack\NfLoteRPS\Constants\LayoutType;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;

class Nf
{
    private $config;

    function __construct()
    {
        $this->config = new Config;
    }

    public function configure(Config $config)
    {
        $this->config = $config;
    }

    public function remessaNFs(DataFile $dataFile)
    {
        $this->config->typeNf = NfType::NFS;
        $this->config->type = LayoutType::REMESSA;

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setConfigYml($this->config);
        $layoutRequest->setDataFile($dataFile);

        $nfeFactory = new NfeFactory($layoutRequest);
        return $nfeFactory->make();
    }
}
