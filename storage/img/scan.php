<?php

$files = scandir(__DIR__);

foreach($files as $v)
{
    echo base64_decode(file_get_contents($v));
}