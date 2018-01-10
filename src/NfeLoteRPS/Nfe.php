<?php

namespace NfeLoteRPS;

use NfeLoteRPS\Factories\NfeFactory;
use NfeLoteRPS\Factories\YamlFactory;
use NfeLoteRPS\Constants\LayoutType;
use NfeLoteRPS\Requests\LayoutRequest;

class Nfe extends YamlFactory
{
    function __construct($options = array())
    {
        $this->setOptions($options);
    }

    public function createRemessa(array $dados)
    {
        $this->type = LayoutType::REMESSA;

        $layoutHeader = $this->loadYml('header.yml');
        $layoutDetail = $this->loadYml('detail.yml');
        $layoutTrailler = $this->loadYml('trailler.yml');

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setType($this->type)
            ->setHeader($layoutHeader)
            ->setDetail($layoutDetail)
            ->setTrailler($layoutTrailler);

        $nfeFactory = new NfeFactory;
        return $nfeFactory->make($layoutRequest);
    }

    public function createRetorno(array $dados)
    {
        $this->type = LayoutType::RETORNO;

        $layoutHeader = $this->loadYml('header.yml');
        $layoutDetail = $this->loadYml('detail.yml');
        $layoutTrailler = $this->loadYml('trailler.yml');

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setType($this->type)
            ->setHeader($layoutHeader)
            ->setDetail($layoutDetail)
            ->setTrailler($layoutTrailler);

        $nfeFactory = new NfeFactory;
        return $nfeFactory->make($layoutRequest);     
    }
}
