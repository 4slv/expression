<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Expression\Expression;

class GetFirstOperandOperation extends Operation
{
    public function resolveReturnTypeName()
    {
        return $this->getFirstOperand()->getSimpleTypeName();
    }

    public function toPhp($code, $codeContext): string
    {
        return '';
    }

    public function getPhpTemplate(): string
    {
        return Expression::FIRST_OPERAND;
    }
}