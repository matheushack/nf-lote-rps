<?php
namespace MatheusHack\NfLoteRPS\Requests;

use MatheusHack\NfLoteRPS\Entities\Config;
use MatheusHack\NfLoteRPS\Entities\DataFile;
use MatheusHack\NfLoteRPS\Factories\YamlFactory;
use MatheusHack\NfLoteRPS\Exceptions\ValidateException;

class LayoutRequest extends YamlFactory
{
    private $layoutHeader = [];

    private $layoutDetail = [];

    private $layoutTrailler = [];

    private $dataFile;

    private $file;

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

    public function getFileHeader()
    {
        $key = key($this->file);
        return $this->file[$key];
    }

    public function getFileDetails()
    {
        $file = $this->file;
        $keyHeader = key($file);
        end($file);
        $keyTrailler = key($file);

        unset($file[$keyHeader]);
        unset($file[$keyTrailler]);

        return array_values($file);
    }


    public function getFileTrailler()
    {
        end($this->file);
        $key = key($this->file);
        return $this->file[$key];
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

    public function setFile($file)
    {
        if(!file_exists($file))
            throw new ValidateException('File not found');

        $content = explode("\r\n", file_get_contents($file));
        $lines = array_filter($content, 'strlen');

        $this->file = $lines;
    }

}
