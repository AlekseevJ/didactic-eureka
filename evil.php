<?php  




class Evil extends Character 
{
    

    public function __construct($lv,$heroLVl)
    {
        $array = ['Devil Eye', 'Slime', 'Allods Lover'];
        $this->hp = 50*$lv+20*$heroLVl;
        $this->maxHp = 50*$lv+20*$heroLVl;
        $this->damage = 10*$lv+3*$heroLVl;
        $this->name = $array[array_rand( $array)];
        $this->XP = 45*$lv +20*$heroLVl;
    }


}