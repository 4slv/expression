<?php

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeBlock;

include 'vendor/autoload.php';

$code = 'for($i = 1; $i = 0; $i = $i + 1){ $i = 1; $a = 2; }';

$codeContext = new CodeContext();
$codeBlock = new CodeBlock();
$php = $codeBlock
    ->setCode($code)
    ->parse($codeContext)
    ->getPhp();

var_dump(
    $php,
    $codeContext->getExpressionPartByLabel('$i')->getPhp()
);