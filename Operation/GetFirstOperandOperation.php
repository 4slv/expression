<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Expression;

class GetFirstOperandOperation extends Operation
{
    public function resolveReturnTypeName()
    {
        return $this->getFirstOperand()->getTypeName();
    }

    public function toPhp($code)
    {
        return '';
    }

    public function getPhpTemplate(): string
    {
        return Expression::FIRST_OPERAND;
    }
}