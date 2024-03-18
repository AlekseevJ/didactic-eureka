<?php

class Starter{
    public $dir = __DIR__;
public function autoloader($path = "", $napas = ""){
   
if($path != "") {$path = $path."/" ;}
foreach( glob("{$path}*.php") as $filename)
{  
    include_once($filename);
}

if($path != "") {$dir = $this->dir."\\".$path; }else {$dir = $this->dir;}

$scan = scandir($dir);
foreach($scan as $k => $v){
    if(str_contains($v,"."))unset($scan[$k]);
}
foreach($scan as $v){  
if(isset($v)) $this->autoloader($v, $napas );
}
}
}
$OBBG = new Starter;
$OBBG-> autoloader();

