<?php

namespace Slov\Expression\Type;

/** Тип данных - деньги */
class MoneyType extends Type
{
    public function toPhp($code)
    {
        return $code;
    }
}