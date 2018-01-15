<?php
namespace MatheusHack\NfLoteRPS\Requests;

use MatheusHack\NfLoteRPS\Entities\Config;
use MatheusHack\NfLoteRPS\Entities\DataFile;
use MatheusHack\NfLoteRPS\Factories\YamlFactory;

class LayoutRequest extends YamlFactory
{
    private $layoutHeader = [];

    private $layoutDetail = [];

    private $layoutTrailler = [];

    private $dataFile;

    public function getLayoutHeader()
    {
        return $this->layoutHeader;
    }

    public function getLayoutDetail()
    {
        return $this->layoutDetail;
    }

    public function getLayoutTrailler()
    {
        return $this->layoutTrailler;
    }

    public function getDataHeader()
    {
        return $this->dataFile->header->toArray();
    }

    public function getDataDetail()
    {
        return $this->dataFile->detail;
    }

    public function getDataTrailler()
    {
        return $this->dataFile->trailler->toArray();
    }        

    public function getPathSaveFile()
    {
        return $this->options->pathSaveFile;
    }

    public function getType()
    {
        return $this->options->type;
    }

    public function getTypeNf()
    {
        return $this->options->typeNf;
    }

    public function setConfigYml(Config $config)
    {
        parent::setOptions($config);
        $this->setLayoutHeader();
        $this->setLayoutDetail();
        $this->setLayoutTrailler();
    }

    public function setDataFile(DataFile $dataFile)
    {
        $this->dataFile = $dataFile;
        return $this;
    }

    public function setLayoutHeader()
    {
        $this->layoutHeader = $this->loadYml('header.yml');
        return $this;
    }

    public function setLayoutDetail()
    {
        $this->layoutDetail = $this->loadYml('detail.yml');
        return $this;
    }    

    public function setLayoutTrailler()
    {
        $this->layoutTrailler = $this->loadYml('trailler.yml');
        return $this;
    }

}
