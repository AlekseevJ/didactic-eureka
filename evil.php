<?php  




class Evil extends Character 
{
    

    public function __construct($heroLVl,$lv = 1)
    {
        $array = ['Devil Eye', 'Slime', 'Allods Lover'];
        $this->hp = 50*$lv+20*$heroLVl;
        $this->maxHp = 50*$lv+20*$heroLVl;
        $this->damage = 13*$lv+3*$heroLVl;
        $this->name = $array[array_rand( $array)];
        $this->XP = 820 ;// 45*$lv +10*$heroLVl;
    }


}