<?php

namespace Slov\Expression\Type;


use Slov\Expression\Code\CodeContext;

/** Тип число с плавающей запятой */
class FloatType extends Type
{
    public function toPhp(CodeContext $codeContext): string
    {
        return $this->getCodeTrim();
    }
}