<?php



trait LevelXP
{

    public $XPbar;
    public $currentXP;
    public $neededXP;
    public $levelXP;

    public $oldLevel;


    public function iGetXP($xp){
        $this->currentXP = $this->currentXP + $xp;
        return $this->checkUp();
    }

    public function checkUp()
    {
        if($this->currentXP >= $this->neededXP){
            $this->oldLevel = $this->levelXP;
            $this->levelUP();
            return 'Gain '.$this->levelXP - $this->oldLevel.' level. Current lvl = '.$this->levelXP.PHP_EOL;
        }else{ return 'Нужно еще '.round($this->neededXP - $this->currentXP).' единиц опыта'.PHP_EOL; }
    }
    public function levelUP(){
        $overXP = $this->currentXP - $this->neededXP;
        
        $this->levelXP +=1;
        $this->neededXP = $this->neededXP * 1.1;
        $this->currentXP = 0 + $overXP;
        if($this->currentXP >= $this->neededXP) $this->levelUP();

       
    }
}