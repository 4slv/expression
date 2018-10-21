<?php

namespace Slov\Expression\Type;


use Slov\Expression\ToPhpTransformer;

/** Тип операнда */
abstract class Type implements ToPhpTransformer {

    public function toPhp($code, $codeContext): string
    {
        return $code;
    }
}