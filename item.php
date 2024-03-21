<?php 



class Item {

    protected $type ;
    protected $name ;
    protected $prefix;

    public function __construct() {
        
        $this->randomCore($this->randomBase($this->type = ["left_hand","right_hand","helmet","chest"][rand(0,3)]));
        
    }

    protected function randomBase($type) {
        switch($type){
            case "left_hand":
                $this->name = ["sword", "knife", "mace", "bow"][rand(0,3)];
                break;
            case "right_hand":
                $this->name = ["shield", "small fork"][rand(0,1)];
                break;
            case "helmet":
                $this->name = ["eagle helmet", "golden helmet"][rand(0,1)];
                break;
            case "chest":
                $this->name = ["cheap chest", "golden chest"][rand(0,1)];
                break;
        }
    }
    protected function randomCore($core){
        $core = rand(0,100);
        switch($core){
            case $core < 5:
                $this->prefix = "legendary";
                break;
            default:
                $this->prefix = "usual";
                break;
        }
    }
    public function sayItemName(){
        return "$this->prefix $this->name". PHP_EOL;
    }
}