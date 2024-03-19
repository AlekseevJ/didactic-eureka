<?php 

require_once('hiro.php');
require_once('evil.php');
require_once('menu.php');
require_once('status.php');


class Battle
{
    private $hiro;
    private $evil;
    private $menu;
    private $status;
    protected $stop_battle = FALSE;
    protected $current_battle = null ;
    public $death_tracker = false;
    
    public function __construct(){
        
        $this->hiro = new Hiro;
        $this->menu = new Menu;
        $this->status = new Status;
    }

    public function battle() {
        
        echo 'Battle start'.PHP_EOL;

            while($this->hiro->isDie() != "Died"){
            $this->menu->chooseRlvl();
            $level = readline("pick:".PHP_EOL);
            $this->evil = new Evil($level,$this->hiro->levelXP);
            
            $this->child_battle($this->hiro,$this->evil);
            
            
            $this->rewards($this->evil->XP);
            unset($this->evil);
            $this->menu->menu();



            }
            echo $this->hiro->SayMyNAME().' погиб страшной смертью.';
            die();
        
    }

    public function rewards($evilRewards)
    {
        $info = $this->hiro->iGetXP($evilRewards);
        print_r($info);
        sleep(3);
    }

    public function child_battle($hiro, $opponent) {
        
        $r =1;
        while($this->death_tracker == false)
        {   echo ' '. PHP_EOL;
            echo 'Raund '. $r.PHP_EOL;
            sleep(1);
            if($this->oneActionBatle($hiro,$opponent) ==2) continue;
            sleep(1);
            if($this->oneActionBatle($opponent,$hiro) ==2) continue;
            $r++;
            sleep(4);
            $this->skipTerminal();
        }
        $this->death_tracker = false;
        $this->current_battle = null;
    }


    public function oneActionBatle($attacker,$defender , $dealer = null){
            $resultAttack = $attacker->attack();
            $resultHits = $defender->hits($resultAttack['Deals']);
            $result['Status'] = [$resultAttack['Status'], $resultHits['Status']];
            
            if($attacker->SayMyNAME() =="hiro") $dealer = 1;
            $status = $this->status->statusV2($result['Status'] , $attacker, $defender, $dealer , $resultAttack['Deals']);
            if(isset($status["Status"]) && $status["Status"] == "Died") {$this->death_tracker = true; return 2;}
            
    }

    public function skipTerminal(){
        for($i=0; $i<30 ; $i++)echo PHP_EOL;
    }
}

$obj = new Battle;
$obj->battle();