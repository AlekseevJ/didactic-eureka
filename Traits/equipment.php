<?php



trait Equipment{
    protected $slots = [
        'left_hand' => null,
        'right_hand' => null,
        'helmet' => null,
        'chest' => null,
    ];

    public function equipEquipment($slot, $item){
        $lastItem = $this->slots[$item] ?? null ;
        $this->slots[$slot] = $item;
        if(isset($lastItem)) return $lastItem;
    }
}