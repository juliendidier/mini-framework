<?php

namespace Formation\Model;

abstract class Article
{
    const VARNISH_COST = 15;

    protected $format;
    protected $paperType;
    public $isVarnished;
    protected $price;
    protected $isEditable;

    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function getPrice()
    {
        return $this->price;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function isVarnished()
    {
        return $this->isVarnished;
    }
}
