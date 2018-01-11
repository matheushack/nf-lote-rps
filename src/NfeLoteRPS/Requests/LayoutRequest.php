<?php

namespace MatheusHack\NfeLoteRPS\Requests;

class LayoutRequest
{
    private $header = [];

    private $detail = [];

    private $trailler = [];

    private $type = 'remessa';

    private $data = [];

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

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getDataHeader()
    {
        if(isset($this->data['header']))
            return $this->data['header'];
        
        return [];
    }

    public function getDatDetail()
    {
        if(isset($this->data['detail']))
            return $this->data['detail'];
        
        return [];
    }

    public function getDataTrailler()
    {
        if(isset($this->data['trailler']))
            return $this->data['trailler'];
        
        return [];
    }        

}
