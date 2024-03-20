<?php



class Menu 
{

    protected $speedC = null;
    protected $chooseDiff = "Choose difficulty:".PHP_EOL."1. Easy".PHP_EOL."2. Medium".PHP_EOL;
    private $exitMenu = false;
    private $actionList = ['Инвентарь', 'Пойти дальше'];
    private $pointChoouse = ['ПОВЫСИТЬ УРОВЕНЬ'];

    public function menu($points = 0){
        $string = '';
        if($points> 0) $list =array_merge($this->actionList,$this->pointChoouse);
        else $list = $this->actionList;
        foreach($list as $k=>$v){
            $string .="[" . $k+1 . "]" . ' ' . $v . PHP_EOL;
           
        }
        $i=0;
        do{
            
        echo "Choouse action:".PHP_EOL.$string;
        if($i >0) echo"text the number";
        $ans = readline("Choose:");
        
        $i++;
        }while(!in_array((int) $ans - 1, array_keys($this->actionList)));
    }

    public function exit(){
        $this->exitMenu = true;
    }

    public function chooseRlvl(){
        $this->realtext($this->chooseDiff, $this->speedC);
    }

    public function realtext($string , $speed = null){
        if(isset($speed)) {
        foreach(str_split($string) as $k=> $v){
            echo $v;
            if($k%3) usleep(rand(1,400)*1000);
        }}else{foreach(str_split($string) as $k=> $v){
            echo $v;
            //if($k%3) usleep(rand(1,400)*1000);
        }
    }


}
public function levelUp(){
    
}
}