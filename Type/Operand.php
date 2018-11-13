<?php

namespace Slov\Expression\Type;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Expression\ExpressionPart;

/** Операнд */
class Operand extends ExpressionPart
{
    public function parse(CodeContext $codeContext): void
    {
        $code = $this->getCode();
    }
}