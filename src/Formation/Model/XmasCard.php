<?php

namespace Formation\Model;

class XmasCard extends Article
{
    protected $ong;

    public function getOng()
    {
        return $this->ong;
    }

    public function setOng(Ong $ong)
    {
        $this->ong = $ong;
    }
}
