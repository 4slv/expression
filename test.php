<?php

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Statement\SimpleStatement;

include 'vendor/autoload.php';

$code = '$i = 1 + 1 * (2 + 1);';

$codeContext = new CodeContext();
$statement = new SimpleStatement();
$php = $statement
    ->setCode($code)
    ->parse($codeContext)
    ->getPhp();

var_dump($php, $codeContext->getExpressionPartByLabel('$i')->getPhp());