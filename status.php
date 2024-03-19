<?php

class Status
{
    protected $speedStatus = 0;
    protected $speedHail = 0;
    protected $dieStatus;
    public $hpBar = ['█ _ _ _ _ _ _ _ _ _ _', '█ █ _ _ _ _ _ _ _ _ _', '█ █ █ _ _ _ _ _ _ _ _', '█ █ █ █ _ _ _ _ _ _ _', '█ █ █ █ █ _ _ _ _ _ _', '█ █ █ █ █ █ _ _ _ _ _', '█ █ █ █ █ █ █ _ _ _ _', '█ █ █ █ █ █ █ █ _ _ _', '█ █ █ █ █ █ █ █ █ _ _', '█ █ █ █ █ █ █ █ █ █ _', '█ █ █ █ █ █ █ █ █ █ █'];


    public function statusV2($status,  $attacker, $defenser, $dealer, $deals = null,)
    {
        $this->dieStatus = false;
        foreach ($status as $v) {
            $speed = $this->speedStatus;
            switch ($v) {
                case "Nothing":

                    break;

                case "Attack":
                    $this->realtext($attacker->SayMyNAME() . " attack ".$deals." ",$speed);
                    break;

                case "Crit":
                    $this->realtext($attacker->SayMyNAME() . " CRITical attack ".$deals." ",$speed);
                    break;

                case "Evade":
                    $this->realtext( $defenser->SayMyNAME() . " evaded ",$speed);
                    break;

                case "Died":
                    $this->realtext( $defenser->SayMyNAME() . $defenser->die().PHP_EOL,$speed);
                    sleep(2);
                    $this->realtext( $defenser->SayMyNAME(). " is died like php".PHP_EOL,$speed);
                    $this-> dieStatus = true;
                    break;

                case "Hits":
                    $this->realtext($defenser->SayMyNAME() . " hits ",$speed);
                    break;

                default:

                    break;
            }
            if($this->dieStatus == true) break;
        }
        if($this->dieStatus == true) return ["Status"=>"Died","Name"=>$defenser->SayMyNAME()];

        // if($check_life == "Evade") {echo $attacker->SayMyNAME()." промахнулся!!!";return;}
        // if($attacker->damage < $attacker->lastDamage){$deal = ' deal '.$attacker->lastDamage.' CRITITCAL damage to ';
        // }else{$deal = ' deal '.$attacker->damage.' damage to ';}
        // if($check_life == true)
        // {
        //     if($this->hiro->isDie()){
        //         $this->dieStatus('hiro', $deal, $attacker,$defenser);
        // }elseif($this->evil->isDie()){
        //     $this->dieStatus('evil', $deal, $attacker,$defenser);
        // }
        // }
        // else
        // {
        // echo $attacker->SayMyNAME().$deal.$defenser->SayMyNAME().'.'. 
        // }

        $this->realtext( $this->hailBar($attacker, $defenser, $dealer).PHP_EOL, $this->speedHail);

    }
    private function hailBar($attacker, $defenser, $dealer): string
    {
        if ($attacker->SayMyNAME() == "Hiro") {
            return '||' . $attacker->SayMyNAME() ." ". $attacker->getHp() ." ". $this->hpBar[$attacker->getHpPercent()] . ' hp' . ' || ' . $defenser->SayMyNAME() ." ". $defenser->getHp() ." ". $this->hpBar[$defenser->getHpPercent()] . ' hp' . ' ||' . PHP_EOL;
        } else
            return $this->hailBar($defenser, $attacker, $dealer = 1);
    }

    public function realtext($string,$speed = 20){
        foreach(str_split($string) as $k=> $v){
            echo $v;
            if($k%3) usleep($speed*1000);
        }
    }
}
