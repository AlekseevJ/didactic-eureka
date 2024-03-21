<?php  

include('character.php');
include('Traits/bag.php');
include('Traits/equipment.php');
include('Traits/levelXP.php');

class Hiro extends Character
{
    use LevelXP, Bag, Equipment;
    private $killCount = 0;
    public function __construct()
    {
        $this->hp = 100;
        $this->maxHp = 100;
        $this->damage = 33;
        $this->name = 'Hiro';
        $this->levelXP = 1;
        $this->neededXP = 100;
        $this->currentXP = 0;
        $this->dex = 15;
        $this->lucky = 15;

    }

    public function equipFromBag($itemKey, $slot){
        $item = $this->getFromTheBag($itemKey);
        $this->equipEquipment($slot, $item);
    }

    public function incCount()
    {
        $this->killCount++;
    }
    public function showCount()
    {
        return $this->killCount;
    }

}