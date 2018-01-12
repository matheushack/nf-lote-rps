<?php
namespace MatheusHack\NfLoteRPS\Entities;

use MatheusHack\NfLoteRPS\Constants\Layout;
use MatheusHack\NfLoteRPS\Constants\NfType;
use MatheusHack\NfLoteRPS\Constants\LayoutType;

class Config
{

    public $pathYml = __DIR__.'/../layout';

    public $type = LayoutType::REMESSA;

    public $typeNf = NfType::NFS;

    public $layout = Layout::REMESSA;

    public $pathSaveFile = '/tmp/';

}