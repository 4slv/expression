<?php

namespace Slov\Expression\Type;


use Slov\Expression\Code\CodeContext;

/** Тип null */
class NullType extends Type
{
    public function toPhp(CodeContext $codeContext): string
    {
        return 'null';
    }
}