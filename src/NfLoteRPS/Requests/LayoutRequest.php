<?php
namespace MatheusHack\NfLoteRPS\Requests;

use MatheusHack\NfLoteRPS\Entities\Config;
use MatheusHack\NfLoteRPS\Entities\DataFile;
use MatheusHack\NfLoteRPS\Factories\YamlFactory;
use MatheusHack\NfLoteRPS\Exceptions\ValidateException;

/**
 * Class LayoutRequest
 * @package MatheusHack\NfLoteRPS\Requests
 */
class LayoutRequest extends YamlFactory
{
    /**
     * @var array
     */
    private $layoutHeader = [];

    /**
     * @var array
     */
    private $layoutDetail = [];

    /**
     * @var array
     */
    private $layoutTrailler = [];

    /**
     * @var
     */
    private $dataFile;

    /**
     * @var
     */
    private $file;

    /**
     * @return array
     */
    public function getLayoutHeader()
    {
        return $this->layoutHeader;
    }

    /**
     * @return array
     */
    public function getLayoutDetail()
    {
        return $this->layoutDetail;
    }

    /**
     * @return array
     */
    public function getLayoutTrailler()
    {
        return $this->layoutTrailler;
    }

    /**
     * @return mixed
     */
    public function getDataHeader()
    {
        return $this->dataFile->header->toArray();
    }

    /**
     * @return mixed
     */
    public function getDataDetail()
    {
        return $this->dataFile->detail;
    }

    /**
     * @return mixed
     */
    public function getDataTrailler()
    {
        return $this->dataFile->trailler->toArray();
    }

    /**
     * @return mixed
     */
    public function getPathSaveFile()
    {
        return $this->options->pathSaveFile;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->options->type;
    }

    /**
     * @return mixed
     */
    public function getTypeNf()
    {
        return $this->options->typeNf;
    }

    /**
     * @return mixed
     */
    public function getFileHeader()
    {
        $key = key($this->file);
        return $this->file[$key];
    }

    /**
     * @return array
     */
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


    /**
     * @return mixed
     */
    public function getFileTrailler()
    {
        end($this->file);
        $key = key($this->file);
        return $this->file[$key];
    }


    /**
     * @param Config $config
     */
    public function setConfigYml(Config $config)
    {
        parent::setOptions($config);
        $this->setLayoutHeader();
        $this->setLayoutDetail();
        $this->setLayoutTrailler();
    }

    /**
     * @param DataFile $dataFile
     * @return $this
     */
    public function setDataFile(DataFile $dataFile)
    {
        $this->dataFile = $dataFile;
        return $this;
    }

    /**
     * @return $this
     * @throws \MatheusHack\NfLoteRPS\Exceptions\LayoutException
     */
    public function setLayoutHeader()
    {
        $this->layoutHeader = $this->loadYml('header.yml');
        return $this;
    }

    /**
     * @return $this
     * @throws \MatheusHack\NfLoteRPS\Exceptions\LayoutException
     */
    public function setLayoutDetail()
    {
        $this->layoutDetail = $this->loadYml('detail.yml');
        return $this;
    }

    /**
     * @return $this
     * @throws \MatheusHack\NfLoteRPS\Exceptions\LayoutException
     */
    public function setLayoutTrailler()
    {
        $this->layoutTrailler = $this->loadYml('trailler.yml');
        return $this;
    }

    /**
     * @param $file
     * @throws ValidateException
     */
    public function setFile($file)
    {
        if(!file_exists($file))
            throw new ValidateException('File not found');

        $content = explode("\r\n", file_get_contents($file));
        $lines = array_filter($content, 'strlen');

        $this->file = $lines;
    }

}
