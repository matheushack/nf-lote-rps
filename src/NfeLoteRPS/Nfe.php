<?php

namespace MatheusHack\NfeLoteRPS;

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

    public function createRemessa(array $data)
    {
        $this->type = LayoutType::REMESSA;

        $layoutHeader = $this->loadYml('header.yml');
        $layoutDetail = $this->loadYml('detail.yml');
        $layoutTrailler = $this->loadYml('trailler.yml');

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setType($this->type)
            ->setData($data)
            ->setHeader($layoutHeader)
            ->setDetail($layoutDetail)
            ->setTrailler($layoutTrailler);

        $nfeFactory = new NfeFactory;
        $remessa = $nfeFactory->make($layoutRequest);

        $file = implode($remessa->header, '');

        foreach($remessa->detail as $detail){
            $file .= implode($detail, '');
        }

        $file .= implode($remessa->trailler, '');

        return $file;
    }

    public function createRetorno(array $data)
    {
        $this->type = LayoutType::RETORNO;

        $layoutHeader = $this->loadYml('header.yml');
        $layoutDetail = $this->loadYml('detail.yml');
        $layoutTrailler = $this->loadYml('trailler.yml');

        $layoutRequest = new LayoutRequest;
        $layoutRequest->setType($this->type)
            ->setData($data)
            ->setHeader($layoutHeader)
            ->setDetail($layoutDetail)
            ->setTrailler($layoutTrailler);

        $nfeFactory = new NfeFactory;
        return $nfeFactory->make($layoutRequest);     
    }
}
