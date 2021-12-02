<?php

namespace Tournament;

class Viking extends Character
{
    public function __construct($type = 'Viking')
    {
        $this->hp = $this->totalHP = 120;
        $this->equip("axe");
        $this->type = $type;
    }
}