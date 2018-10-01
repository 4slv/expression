<?php

namespace Slov\Expression\Type;


use Slov\Expression\StringToPhp;

/** Тип операнда */
abstract class Type implements StringToPhp {

    public function toPhp($code)
    {
        return $code;
    }

}