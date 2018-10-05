<?php

namespace Slov\Expression\Type;


use Slov\Expression\CodeToPhp;

/** Тип операнда */
abstract class Type implements CodeToPhp {

    public function toPhp($code)
    {
        return $code;
    }

}