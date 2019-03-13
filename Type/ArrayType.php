<?php

namespace Slov\Expression\Type;

use Slov\Expression\Code\CodeContext;

/* Тип массив */
class ArrayType extends Type
{
    public function toPhp(CodeContext $codeContext): string
    {
        return $this->getCodeTrim();
    }
}