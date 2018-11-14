<?php

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\Operand;

include 'vendor/autoload.php';

/*$code = trim(str_replace(
    '<?php',
    '',
    file_get_contents('testCode.php')
));*/

$code = '1';

$codeContext = new CodeContext();
$operand = new Operand();
$php = $operand
    ->setCode($code)
    ->parse($codeContext)
    ->getPhp();

var_dump($php);