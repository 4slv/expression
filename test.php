<?php

use Slov\Expression\Bracket\BracketParser;
use Slov\Expression\Bracket\BracketType;


include 'vendor/autoload.php';



$bracketParser = new BracketParser();
$parts = $bracketParser->split('function(1,2,3) + 1,2,3', BracketType::ROUND_BRACKETS(), ',');

var_dump($parts);