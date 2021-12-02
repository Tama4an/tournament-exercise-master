<?php
namespace Tournament;

class Swordsman extends Character
{

    public function __construct($type = 'Swordsman')
    {
        $this->hp = $this->totalHP = 100;
        $this->equip('1 hand sword');
        $this->type = $type;
    }

}
