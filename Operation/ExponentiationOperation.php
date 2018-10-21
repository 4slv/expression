<?php

namespace Slov\Expression\Operation;

/** Операция возведения в степень */
class ExponentiationOperation extends DigitOperation
{
    public function resolveReturnTypeName()
    {
        return $this->resolveDigitReturnTypeName();
    }

    public function toPhp($code, $codeContext): string
    {
        if(
            $this->getFirstOperandTypeName()->isDigit()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $this->toPhpSameCode($code);
        }
        return null;
    }

    public function getPhpTemplate(): string
    {
        return parent::getPhpTemplatePrimitive();
    }
}