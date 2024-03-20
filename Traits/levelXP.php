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
        $this->oldLevel = $this->levelXP;
        return $this->checkUp();
    }

    public function checkUp()
    {
        if($this->currentXP >= $this->neededXP){
            $i = 1;
        while($i == 1){   
        $overXP = $this->currentXP - $this->neededXP;
        $this->levelXP +=1;
        $this->neededXP = $this->neededXP * 1.1;
        $this->currentXP = 0 + $overXP;
        if($this->currentXP < $this->neededXP) $i = 0;
        }
            return ['Status'=>(int)($this->levelXP - $this->oldLevel),'Text'=>'Gain '.$this->levelXP - $this->oldLevel.' level. Current lvl = '.$this->levelXP.PHP_EOL];
        }else{ return ['Status'=>0 ,'Text'=>'Нужно еще '.round($this->neededXP - $this->currentXP).' единиц опыта'.PHP_EOL]; }
    }
}