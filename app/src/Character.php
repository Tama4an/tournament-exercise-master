<?php

namespace Tournament;

class Character
{
    public $hp = 0;
    public $totalHP = 0;
    public $damage = 0;
    public $defence = 0;
    public $buckler = null;
    public $weapon = null;
    public $type = null;

    public function equip($item)
    {
        $equipment = (new Equipment($item));
        $this->checkEquip($equipment);

        return $this;
    }

    public function engage($character)
    {
        do {

            $this->attack($character);

            if ($character->hp > 0) {
                $character->attack($this);
            }

        } while (($this->hp > 0) && ($character->hp > 0));

    }

    public function hitPoints()
    {
        return $this->hp;
    }

    private function checkEquip($equipment)
    {
        if ($equipment->damage) {
            $this->damage += $equipment->damage;
            if (!$equipment->defence) {
                if ($this->weapon) {
                    $this->damage -= $this->weapon->damage;
                }
                $this->weapon = $equipment;
            }
        }
        if ($equipment->defence) {
            $this->defence += $equipment->defence;
        }
        if ($equipment->durability) {
            $this->buckler = $equipment;
        }
    }

    private function attack($character) {
        $damage = $this->calculateDamage($character);
        if ($damage) {
            if ($character->hp < $damage) {
                $character->hp = 0;
            } else {
                $character->hp -= $damage;
            }
        }
    }

    private function calculateDamage($character) {
        // add default weapon damage
        $damage = $this->damage;

        // check Vicious mechanic
        if (($this->type === 'Vicious') && ($this->weapon->numberOfHits < 2)) {
            $damage += 20;
            $this->weapon->numberOfHits += 1;
        }

        // check 2 hand sword mechanic
        if ($this->weapon->type === '2 hand sword') {
            $this->weapon->numberOfHits += 1;
            if (!($this->weapon->numberOfHits % 3)) {
                $damage = 0;
            } elseif (($this->type === 'Veteran') && ($this->hp <= ($this->totalHP * 0.3))) {
                $damage *= 2;
            }
        }

        // check buckler mechanic
        if ($character->buckler) {
            $character->buckler->numberOfHits += 1;
            if (!($character->buckler->numberOfHits % 2)) {
                $damage = 0;
                if ($this->weapon->type === 'axe') {
                    $character->buckler->durability -= 1;
                    if ($character->buckler->durability === 0) {
                        $character->buckler = null;
                    }
                }
            }
        }

        // check armor mechanic
        if ($character->defence && ($character->defence < $damage)) {
            $damage = $damage - $character->defence;
        }

        // return calculated damage
        return $damage;
    }
}