<?php

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeBlock;

include 'vendor/autoload.php';

$code = 'if(false){ $i = 1; $a = 2; }';

$codeContext = new CodeContext();
$codeBlock = new CodeBlock();
$php = $codeBlock
    ->setCode($code)
    ->parse($codeContext)
    ->getPhp();

var_dump(
    $php,
    $codeContext->getExpressionPartByLabel('$i')->getPhp(),
    $codeContext->getExpressionPartByLabel('$a')->getPhp()
);