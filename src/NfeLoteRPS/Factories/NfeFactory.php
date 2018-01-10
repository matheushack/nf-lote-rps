<?php

namespace NfeLoteRPS\Factories;

use NfeLoteRPS\Requests\LayoutRequest;

class NfeFactory
{
    public function make(LayoutRequest $layoutRequest)
    {
        return $layoutRequest;
    }
}
