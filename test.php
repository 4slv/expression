<?php

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeExecutor;

include 'vendor/autoload.php';

$code = 'for($i = 1; false; $i = $i + 1){ $i = 1; $a = 2; }';

$codeContext = new CodeContext();
$codeBlock = new CodeExecutor();
$variableList = $codeBlock
    ->setCode($code)
    ->setCodeContext($codeContext)
    ->execute()
    ->getVariableList();

var_dump($variableList);