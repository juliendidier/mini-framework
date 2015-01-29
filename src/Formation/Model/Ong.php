<?php

namespace Formation\Model;

class Ong
{
    public $name;
    public $website;
    public $commissionRate;

    public function __construct($name, $website, $commissionRate)
    {
        $this->name = $name;
        $this->website = $website;
        $this->commissionRate = $commissionRate;
    }
}
