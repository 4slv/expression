<?php

namespace Slov\Expression\Type;


use Slov\Expression\Code\CodeContext;

/** Тип логическое значение */
class BooleanType extends Type
{
    public function toPhp(CodeContext $codeContext): string
    {
        return $this->getCodeTrim();
    }
}