<?php

require_once ('hiro.php');
require_once ('evil.php');
require_once ('menu.php');
require_once ('status.php');
require_once ('item.php');


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

    public function __construct()
    {

        $this->hiro = new Hiro;
        $this->menu = new Menu;
        $this->status = new Status;
    }


    public function startGame()
    {

    }

    public function actionQueue()
    {
        // 1 even  2 menu action 3 fight 4 reward  2(1)-3-4
        while (1) {
            //3 figh

            $ans = $this->checkMenuWithPoint();

            $this->actionChoice($ans);



        }
    }
    public function checkMenuWithPoint(){
        if ($this->hiro->howSkillPoint() > 0) {
            $points = $this->hiro->howSkillPoint();
            // menu
            return $ans = $this->menu->menu($points);
        } else
         return $ans = $this->menu->menu();
    }
    public function rewards($evilRewards)
    {

        $info = $this->hiro->iGetXP($evilRewards);
        //  Array ( [Status] => 0
//            [Text] => Нужно еще 45 единиц опыта )
        if ($info['Status'] > 0) {
            $this->hiro->getSkillPoint($info['Status']);
        }
        echo $info['Text'];

        sleep(1);


    }
    public function battle()
    {

        echo 'Battle start' . PHP_EOL;
        $this->child_battle($this->hiro, $this->evil);
    }
    public function child_battle($hiro, $opponent)
    {
        $r = 1;
        while ($this->death_tracker == false) {
            echo ' ' . PHP_EOL;
            echo 'Raund ' . $r . PHP_EOL;
            sleep(1);
            $chek = $this->oneActionBatle($hiro, $opponent);
            if ($chek == 2) {
                $hiro->incCount();
                continue;
            } elseif ($chek == 3) {
                $this->hiro_death_tracker = true;
                continue;
            }
            sleep(1);
            $chek = $this->oneActionBatle($opponent, $hiro);
            if ($chek == 2) {
                continue;
            } elseif ($chek == 3) {
                $this->hiro_death_tracker = true;
                continue;
            }
            $r++;
            sleep(1);
            $this->skipTerminal();
        }
        $this->death_tracker = false;
    }

    public function oneActionBatle($attacker, $defender, $dealer = null)
    {
        $resultAttack = $attacker->attack();
        $resultHits = $defender->hits($resultAttack['Deals']);
        $result['Status'] = [$resultAttack['Status'], $resultHits['Status']];
        if ($attacker->SayMyNAME() == "hiro")
            $dealer = 1;
        $status = $this->status->statusV2($result['Status'], $attacker, $defender, $dealer, $resultAttack['Deals']);
        if (isset ($status["Status"]) && $status["Status"] == "Died" && $defender->SayMyNAME() == "Hiro") {
            $this->death_tracker = true;
            return 3;
        }
        if (isset ($status["Status"]) && $status["Status"] == "Died") {
            $this->death_tracker = true;
            return 2;
        }

    }
    public function skipTerminal()
    {
        for ($i = 0; $i < 30; $i++)
            echo PHP_EOL;
    }

    public function actionChoice($ansv)
    {
        switch ($ansv) {
            case '1':
                $signalEnd = false;
                while($signalEnd == false){
                    $bag =array_merge($this->hiro->showTheBag(), ["Nazad"]);
                $ans = $this->menu->customMenu($bag);
                if($ans == count($bag)) $signalEnd = true;
                }
                break;
            case '2':
                $this->evil = new Evil($this->hiro->levelXP); //$level,
                $this->battle();
                if ($this->hiro_death_tracker == true) {
                    echo 'killed ' . $this->hiro->showCount() . ' монстров' . PHP_EOL . 'конец игры';
                    break;
                }
                //4 reward
                $this->rewards($this->evil->gainXP());
                unset($this->evil);

                $item = new Item;
                echo "вы полчили ". $item->sayItemName();
                $this->hiro->putInTheBag($item);
//                 array(1) {
//   [0]=>
//   object(Item)#5 (3) {
//     ["type":protected]=>
//     string(9) "left_hand"
//     ["name":protected]=>
//     string(5) "knife"
//     ["prefix":protected]=>
//     string(9) "legendary"
//   }
// }

                var_dump($this->hiro->showTheBag());die();
                break;
            case '3':
                $signalEnd = false;
                while($this->hiro->howSkillPoint() > 0 && $signalEnd == false){
                $pointss = $this->hiro->howSkillPoint();
                    echo "you have $pointss skillpoints".PHP_EOL;
                $ans = $this->menu->customMenu(["str","dex","luck","nazad"]);
                $signalEnd = $this->hiro->paySkillpoints($ans-1);
                }
                $this->hiro->myStats();
                sleep(1);
                break;
            default:
                # code...
                break;
        }
    }
}

$obj = new Battle;
$obj->actionQueue();