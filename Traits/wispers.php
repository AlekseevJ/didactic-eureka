<?php 



trait Wispers 
{
    public $wisper = [' arh..',' arrghhhhh....'];

    public function deathWisp(){
        return $this->wisper[rand(0, count($this->wisper)-1)];
    }
}