<?php

namespace Slov\Expression\Type;

use Slov\Expression\Code\CodeContext;

/** Тип целое число */
class IntType extends Type
{
    public function toPhp(CodeContext $codeContext): string
    {
        return $this->getCodeTrim();
    }
}