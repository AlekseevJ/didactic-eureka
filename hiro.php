<?php  

include('character.php');
include('Traits/bag.php');
include('Traits/equipment.php');
include('Traits/levelXP.php');

class Hiro extends Character
{
    use LevelXP, Bag, Equipment;
    public function __construct()
    {
        $this->hp = 100;
        $this->maxHp = 100;
        $this->damage = 10;
        $this->name = 'Hiro';
        $this->crit = 7;
        $this->levelXP = 1;
        $this->neededXP = 100;
        $this->currentXP = 0;
        $this->dex = 80;

    }

    public function equipFromBag($itemKey, $slot){
        $item = $this->getFromTheBag($itemKey);
        $this->equipEquipment($slot, $item);
    }

}