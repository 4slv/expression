<?php

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Expression\ExpressionWithoutBrackets;
use Slov\Expression\Operation\Operation;

include 'vendor/autoload.php';

$code = '1 + 1 * 2';

$codeContext = new CodeContext();
$expression = new ExpressionWithoutBrackets();
$php = $expression
    ->setCode($code)
    ->parse($codeContext)
    ->getPhp();

var_dump($php);