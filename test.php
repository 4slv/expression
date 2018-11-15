<?php

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Operation\Operation;

include 'vendor/autoload.php';

/*$code = trim(str_replace(
    '<?php',
    '',
    file_get_contents('testCode.php')
));*/

$code = '1 + 1';

$codeContext = new CodeContext();
$operation = new Operation();
$php = $operation
    ->setCode($code)
    ->parse($codeContext)
    ->getPhp();

var_dump($php);