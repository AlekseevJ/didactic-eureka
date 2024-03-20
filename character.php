<?php  

include('Traits/wispers.php');

class Character  
{
    use Wispers;
    protected $hp ;
    public $damage ;
    protected $maxHp ;
    protected $crit = 0.25;
    public $lastDamage ;
    public $XP ;
    protected $str = 0; 
    protected $dex = 0;
    protected $lucky = 0 ;
    protected $statuses = ["Nothing", "Crit"  ,"Evade", "Died", "Attack", "Hits"]; 
    protected $skillpoints = 0;
    protected $name ;
//$str $dex $lucky



    public function getSkillPoint($skillpoints)
    {
        $this->skillpoints = $this->skillpoints + $skillpoints;
    }
    public function howSkillPoint()
    {
        return $this->skillpoints;
    }
    public function paySkillpoints(){

    }
    
    public function attack(){
        if($this->doesLuckyShot()){$dd =["Status"=>$this->statuses[1] ,"Deals"=>$this->damage + $this->damage * ($this->crit+$this->dex*0.05)]; $this->lastDamage = $dd; }
        else $dd = ["Status"=>$this->statuses[4],"Deals"=>$this->damage];
        return $dd;
    }
    public function doesLuckyShot() 
    {   
        if( rand(0, 100) <= $this->dex *5) return true;
        else return false;
    }
    protected function calcCrit(){
        return ;
    }
    public function hits($damage){
        if($this->evade() == true) {$hh =["Status"=> $this->statuses[2] ];}
        else {$this->hp = $this->hp - $damage;
        $hh = ["Status"=>$this->isDie()??$this->statuses[5]];}
        return $hh;
    }
    public function evade(){
        $rand = rand(0,99);
        if($rand <= $this->lucky*3.5) return true;
        return false;
    }
    

    public function getHp(){
        return $this->hp;
    }
    public function getHpPercent(){
        $hp = round(($this->hp / $this->maxHp)*100);
        if($hp>10){return round($hp/10);}else return 1 ;
    }
    public function isDie(){
        if($this->hp > 0) return null;else return $this->statuses[3];
    }

    public function die(){
        return $this->deathWisp();
    }
    public function SayMyNAME(){
        return $this->name;
    }
    public function gainXP()
    {
        return $this->XP;
    }

    public function action(){

    }
}