<?php

namespace MatheusHack\NfLoteRPS;

use MatheusHack\NfLoteRPS\Entities\Config;
use MatheusHack\NfLoteRPS\Constants\NfType;
use MatheusHack\NfLoteRPS\Entities\DataFile;
use MatheusHack\NfLoteRPS\Factories\Remessa\RemessaFactory;
use MatheusHack\NfLoteRPS\Factories\Retorno\RetornoFactory;
use MatheusHack\NfLoteRPS\Constants\LayoutType;
use MatheusHack\NfLoteRPS\Requests\LayoutRequest;

/**
 * Class Nf
 * @package MatheusHack\NfLoteRPS
 */
class Nf
{
    /**
     * @var Config
     */
    private $config;

    /**
     * Nf constructor.
     */
    function __construct()
    {
        $this->config = new Config;
    }

    /**
     * @param Config $config
     */
    public function configure(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param DataFile $dataFile
     * @return string
     */
    public function remessaNFs(DataFile $dataFile)
    {
        $this->config->typeNf = NfType::NFS;
        $this->config->type = LayoutType::REMESSA;

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setConfigYml($this->config);
        $layoutRequest->setDataFile($dataFile);

        $nfeFactory = new RemessaFactory($layoutRequest);
        return $nfeFactory->make();
    }

    /**
     * @param DataFile $dataFile
     * @return string
     */
    public function remessaNFTs(DataFile $dataFile)
    {
        $this->config->typeNf = NfType::NFTS;
        $this->config->type = LayoutType::REMESSA;

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setConfigYml($this->config);
        $layoutRequest->setDataFile($dataFile);

        $remessaFactory = new RemessaFactory($layoutRequest);
        return $remessaFactory->make();
    }

    /**
     * @param $file
     * @return DataFile
     * @throws Exceptions\ValidateException
     */
    public function retornoNFs($file)
    {
        $this->config->typeNf = NfType::NFS;
        $this->config->type = LayoutType::RETORNO;

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setConfigYml($this->config);
        $layoutRequest->setFile($file);

        $retornoFactory = new RetornoFactory($layoutRequest);
        return $retornoFactory->make();
    }
}
