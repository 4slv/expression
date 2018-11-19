<?php

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Operation\Operation;

include 'vendor/autoload.php';

/* $code = '1 + 1';

$codeContext = new CodeContext();
$operation = new Operation();
$php = $operation
    ->setCode($code)
    ->parse($codeContext)
    ->getPhp();

var_dump($php); */

$pof = new \Slov\Expression\Operation\PriorityOperationFinder();
echo $pof->find('1 + 1 * 2');