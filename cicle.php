<?php

class Cicle
{
    use Trat;
    public function start()
    {   $ans = 10;
        while($ans != 0){
           $ans = readline('напиши 0');
        }
    }
}