<?php



trait Bag
{
    protected $bagSpace = 12;
    protected $currentBag = 0;
    protected $inBag = [];

    public function putInTheBag($item = null){
        if($this->checkCarry() && isset($item)) $this->inBag[] = $item;
        else return false;
    }
    protected function checkCarry(){
        if($this->currentBag >= $this->bagSpace) return false;
        return true;
    }
    public function getFromTheBag($itemKey)
    {
        $item = $this->inBag[$itemKey];
        unset($this->inBag[$itemKey]);
        return $item;
    }
    public function showTheBag()
    {
        return $this->inBag;
    }
}