<?php

$max = 3;
for($i = 1; $i < 10; $i = $i + 1){
    $max = $max - 1;
    if($i > $max)
    {
        $max = $i;
    }
    $max = $max + 1;
}
$max = $max + 1;