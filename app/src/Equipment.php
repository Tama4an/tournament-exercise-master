<?php

namespace Tournament;

class Equipment
{
    public $type = 'empty hand';
    public $damage = null; // can be 0 and negative if we put on the armor before the weapon
    public $defence = null;
    public $numberOfHits = null; // this var for counting hits number for specific equip like a "Great Sword" and "buckler"
    public $durability = null; // this var for specific armor like a "buckler"

    public function __construct($type)
    {
        if ($type === 'axe') {
            $this->getAxe();
        } elseif ($type === 'buckler') {
            $this->getBuckler();
        } elseif ($type === 'armor') {
            $this->getArmor();
        } elseif ($type === '1 hand sword') {
            $this->getOneHandSword();
        } elseif ($type === '2 hand sword') {
            $this->getTwoHandSword();
        }
    }

    private function getAxe()
    {
        $this->type = 'axe';
        $this->numberOfHits = 0;
        $this->setDamage(6);
    }

    private function getBuckler()
    {
        $this->type = 'buckler';
        $this->numberOfHits = 0;
        $this->durability = 3;

    }

    private function getArmor()
    {
        $this->type = 'armor';
        $this->setDamage(-1);
        $this->defence = 3;
    }

    private function getOneHandSword()
    {
        $this->type = '1 hand sword';
        $this->setDamage(5);
        $this->numberOfHits = 0;
    }

    private function getTwoHandSword()
    {
        $this->type = '2 hand sword';
        $this->setDamage(12);
        $this->numberOfHits = 0;
    }

    private function setDamage($damage)
    {
        if ($this->damage) {
            $this->damage += $damage;
        } else {
            $this->damage = $damage;
        }
    }
}