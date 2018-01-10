<?php

namespace NfeLoteRPS\Requests;

class LayoutRequest
{
    private $header = [];

    private $detail = [];

    private $trailler = [];

    private $type = 'remessa';

    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function setTrailler($trailler)
    {
        $this->trailler = $trailler;
        return $this;
    }

    public function getTrailler()
    {
        return $this->trailler;
    }        

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

}
