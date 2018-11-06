<?php

include 'vendor/autoload.php';

$code = trim(str_replace(
    '<?php',
    '',
    file_get_contents('testCode.php')
));


var_dump($code);