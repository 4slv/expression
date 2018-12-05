<?php

namespace Slov\Expression\Type;


use Slov\Expression\Code\CodeContext;

class StringType extends Type
{
    public function toPhp(CodeContext $codeContext): string
    {
        return $this->getCodeTrim();
    }
}