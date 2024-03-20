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
    private $trueBattle;
    protected $stop_battle = FALSE;
    public $death_tracker = false;

    public $hiro_death_tracker = false;
    
    public function __construct(){
        
        $this->hiro = new Hiro;
        $this->menu = new Menu;
        $this->status = new Status;
    }


    public function startGame(){

    }

    public function actionQueue(){
        // 1 even  2 menu action 3 fight 4 reward  2(1)-3-4
        while(1){
        $this->evil = new Evil($this->hiro->levelXP); //$level,
        $this->battle();
        if($this->hiro_death_tracker == true) {echo 'убито '.$this->hiro->showCount().' монстров'.PHP_EOL.'конец игры';break;}
        $this->rewards($this->evil->gainXP());
        unset($this->evil);
        if($this->hiro->howSkillPoint()>0) {$points = $this->hiro->howSkillPoint();
            
        $this->menu->menu($points);}
        else  $this->menu->menu();
        
    }
    }
    public function rewards($evilRewards)
    {
        
        $info = $this->hiro->iGetXP($evilRewards);
//  Array ( [Status] => 0
//            [Text] => Нужно еще 45 единиц опыта )
        if($info['Status'] >0){ $this->hiro->getSkillPoint($info['Status']);}
        echo $info['Text'];

        sleep(3);
        

    }
    public function battle() {
        
        echo 'Battle start'.PHP_EOL;
            $this->child_battle($this->hiro,$this->evil);
    }
    public function child_battle($hiro, $opponent) {
        $r =1;
        while($this->death_tracker == false)
        {   echo ' '. PHP_EOL;
            echo 'Raund '. $r.PHP_EOL;
            sleep(1);
            $chek = $this->oneActionBatle($hiro,$opponent);
            if($chek ==2) { $hiro->incCount() ;continue;}elseif($chek == 3) {$this->hiro_death_tracker = true; continue;}
            sleep(1);
            $chek = $this->oneActionBatle($opponent,$hiro);
            if($chek  ==2){ continue;}elseif($chek == 3) {$this->hiro_death_tracker = true; continue;}
            $r++;
            sleep(4);
            $this->skipTerminal();
        }
        $this->death_tracker = false;
    }

    public function oneActionBatle($attacker,$defender , $dealer = null){
            $resultAttack = $attacker->attack();
            $resultHits = $defender->hits($resultAttack['Deals']);
            $result['Status'] = [$resultAttack['Status'], $resultHits['Status']];
            if($attacker->SayMyNAME() =="hiro") $dealer = 1;
            $status = $this->status->statusV2($result['Status'] , $attacker, $defender, $dealer , $resultAttack['Deals']);
            if(isset($status["Status"]) && $status["Status"] == "Died" && $defender->SayMyNAME() == "Hiro") {$this->death_tracker = true;return 3;}
            if(isset($status["Status"]) && $status["Status"] == "Died") {$this->death_tracker = true; return 2;}
            
    }
    public function skipTerminal(){
        for($i=0; $i<30 ; $i++)echo PHP_EOL;
    }
}

$obj = new Battle;
$obj->actionQueue();