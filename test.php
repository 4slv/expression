<?php

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Expression\AssignExpression;
use Slov\Expression\Expression\ExpressionWithBrackets;
use Slov\Expression\Expression\ExpressionWithoutBrackets;
use Slov\Expression\Operation\Operation;

include 'vendor/autoload.php';

$code = '$i = 1 + 1 * (2 + 1)';

$codeContext = new CodeContext();
$expression = new AssignExpression();
$php = $expression
    ->setCode($code)
    ->parse($codeContext)
    ->getPhp();

var_dump($php, $codeContext->getExpressionPartByLabel('$i')->getPhp());