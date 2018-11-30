<?php

use Slov\Expression\Bracket\BracketParser;
use Slov\Expression\Bracket\BracketType;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeExecutor;
use Slov\Expression\Functions\FunctionList;
use Slov\Expression\Functions\FunctionListBuilder;
use Slov\Expression\Functions\InlineFunctions;

include 'vendor/autoload.php';

/*$code = 'for($i = 1; false; $i = $i + 1){ $i = 1; $a = 2; }';

$codeContext = new CodeContext();
$codeBlock = new CodeExecutor();
$variableList = $codeBlock
    ->setCode($code)
    ->setCodeContext($codeContext)
    ->execute()
    ->getVariableList();*/

$bracketParser = new BracketParser();
$parts = $bracketParser->split('function(1,2,3) + 1,2,3', BracketType::ROUND_BRACKETS(), ',');

var_dump($parts);