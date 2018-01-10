<?php

namespace NfeLoteRPS\Factories;

use NfeLoteRPS\Constants\Layout;
use NfeLoteRPS\Constants\LayoutType;

class YamlFactory
{
    private $pathYml;

    private $type;

    private $layout;

    function __construct($options = array())
    {
        $this->setOptions($options);
    }

    private function setOptions(array $newOptions)
    {
        $default = [
            'pathYml' => dirname(__FILE__).'/../layout',
            'type' => LayoutType::REMESSA,
            'layout' => Layout::REMESSA,
        ];

        $options = array_merge($default, $newOptions);

        foreach($options as $option => $value){
            if(array_key_exists($option,$default)){
                if($option == 'type' && in_array($value, [LayoutType::REMESSA, LayoutType::RETORNO]))
                    $this->$option = $value;
                else if($option != 'type')
                    $this->$option = $value;
            }
        }
    }

    public function loadYml($file)
    {
        $filename = "{$this->pathYml}/{$this->layout}/{$this->type}/$file";

        if (file_exists($filename))
            return spyc_load_file($filename);
        
        return false;
    }

}
