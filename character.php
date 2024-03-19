<?php  

include('Traits/stats.php');
include('Traits/wispers.php');

class Character  
{
    use Wispers, stats;
    protected $hp ;
    public $damage ;
    protected $maxHp ;
    protected $crit ;
    public $lastDamage ;
    public $XP ;
    protected $statuses = ["Nothing", "Crit"  ,"Evade", "Died", "Attack", "Hits"]; 

    protected $name ;


    public function attack(){
        if($this->doesLuckyShot()){$dd =["Status"=>$this->statuses[1] ,"Deals"=>$this->damage + $this->damage * 0.25]; $this->lastDamage = $dd; }
        else $dd = ["Status"=>$this->statuses[4],"Deals"=>$this->damage];
        return $dd;
    }
    public function doesLuckyShot() 
    {
        if($this->crit == 0) return false;
        elseif( rand(0, 10 - ($this->crit) == 10-$this->crit)) return true;
        else return false;
    }
    public function hits($damage){
        if($this->evade() == true) {$hh =["Status"=> $this->statuses[2] ];}
        else {$this->hp = $this->hp - $damage;
        $hh = ["Status"=>$this->isDie()??$this->statuses[5]];}
        return $hh;
    }
    public function evade(){
        $rand = rand(0,99);
        if($rand <= $this->dex) return true;
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