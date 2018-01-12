<?php

namespace MatheusHack\NfeLoteRPS;

use MatheusHack\NfeLoteRPS\Constants\NfType;
use MatheusHack\NfeLoteRPS\Factories\NfeFactory;
use MatheusHack\NfeLoteRPS\Factories\YamlFactory;
use MatheusHack\NfeLoteRPS\Constants\LayoutType;
use MatheusHack\NfeLoteRPS\Requests\LayoutRequest;

class Nfe extends YamlFactory
{
    function __construct($options = array())
    {
        $this->setOptions($options);
    }

    public function remessaNFs(array $data)
    {
        $this->typeNf = NfType::NFS;
        $this->type = LayoutType::REMESSA;

        $layoutHeader = $this->loadYml('header.yml');
        $layoutDetail = $this->loadYml('detail.yml');
        $layoutTrailler = $this->loadYml('trailler.yml');

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setType($this->type)
            ->setTypeNf($this->typeNf)
            ->setData($data)
            ->setHeader($layoutHeader)
            ->setDetail($layoutDetail)
            ->setTrailler($layoutTrailler);

        $nfeFactory = new NfeFactory($layoutRequest);
        return $nfeFactory->make();
    }

    public function retornoNFs(array $data)
    {
        $this->typeNf = NfType::NFS;
        $this->type = LayoutType::RETORNO;

        $layoutHeader = $this->loadYml('header.yml');
        $layoutDetail = $this->loadYml('detail.yml');
        $layoutTrailler = $this->loadYml('trailler.yml');

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setType($this->type)
            ->setTypeNf($this->typeNf)        
            ->setData($data)
            ->setHeader($layoutHeader)
            ->setDetail($layoutDetail)
            ->setTrailler($layoutTrailler);

        $nfeFactory = new NfeFactory($layoutRequest);
        return $nfeFactory->make();
    }
}
