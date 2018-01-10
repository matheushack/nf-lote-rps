<?php

namespace NfeLoteRPS;

use NfeLoteRPS\Factories\NfeFactory;

class Nfe extends NfeFactory
{
    function __construct($options = array ())
    {
        parent::__construct($options);
    }

    public function createRemessa()
    {
        return $this->loadYml('detail.yml');
    }

    public function createRetorno()
    {
        return 'retorno';
    }
}
