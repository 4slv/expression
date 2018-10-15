<?php

use Slov\Expression\CodeExecutor;

include 'vendor/autoload.php';

$code = trim(str_replace(
    '<?php',
    '',
    file_get_contents('testCode.php')
));


$codeExecutor = new CodeExecutor();
$codeExecutor
    ->setCode($code)
    ->execute();