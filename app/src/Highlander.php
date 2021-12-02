<?php

namespace Tournament;

class Highlander extends Character
{

    public function __construct($type = 'Highlander')
    {
        $this->hp = $this->totalHP = 150;
        $this->equip('2 hand sword');
        $this->type = $type;
    }

}