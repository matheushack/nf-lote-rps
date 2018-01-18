<?php
namespace MatheusHack\NfLoteRPS\Entities;

use MatheusHack\NfLoteRPS\Constants\Layout;
use MatheusHack\NfLoteRPS\Constants\NfType;
use MatheusHack\NfLoteRPS\Constants\LayoutType;

/**
 * Class Config
 * @package MatheusHack\NfLoteRPS\Entities
 */
class Config
{

    /**
     * @var string
     */
    public $pathYml = __DIR__.'/../layout';

    /**
     * @var string
     */
    public $type = LayoutType::REMESSA;

    /**
     * @var string
     */
    public $typeNf = NfType::NFS;

    /**
     * @var int
     */
    public $version = 2;

    /**
     * @var string
     */
    public $pathSaveFile = '/tmp';

}