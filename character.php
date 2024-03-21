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
    public function paySkillpoints($sk){
        switch ($sk) {
            case 0:
                if($this->str <20){$this->str = (int)  $this->str+ 1;
                echo "your strong increased".PHP_EOL;
                $this->sellSkillpoint();
                $this->updatetStats();
                } else echo "you are strong like buivol".PHP_EOL;
                return false;
                
            case 1:
                if($this->dex <20){
                $this->dex = (int) $this->dex + 1;
                echo "your agiled".PHP_EOL;
                $this->sellSkillpoint();}
                else echo "you are swift like wind".PHP_EOL;
                return false;

            case 2:
                if($this->lucky <20){
                $this->lucky = (int) $this->lucky+ 1;
                echo "luck increased".PHP_EOL;
                $this->sellSkillpoint();}
                else echo "you are luck like a godness of luck".PHP_EOL;
                return false;
            
            case 3:
                
                return true;

            default:
                # code...
                break;
            }
        
    }
    public function updatetStats(){
        $this->damage = $this->damage * 1.1;
        $this->maxHp = $this->maxHp *1.1;
    }
    protected function sellSkillpoint(): void{
        $this->skillpoints = $this->skillpoints - 1;
    }
    public function myStats(){
       echo "str $this->str dex $this->dex luck $this->lucky ".PHP_EOL;
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
        if($this->lucky >=10 && $rand <= 60 + (($this->lucky - 10) * 3.5 )) {return true;}
        elseif($rand <= $this->lucky*5 ) return true;
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