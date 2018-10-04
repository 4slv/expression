<?php

namespace Slov\Expression\Operation;

/** Операция возведения в степень */
class ExponentiationOperation extends DigitOperation
{
    public function resolveReturnTypeName()
    {
        return $this->resolveDigitReturnTypeName();
    }

    /**
     * @param string $code псевдо-код операции
     * @return string php-код операции
     */
    public function toPhp($code)
    {
        if(
            $this->getFirstOperandTypeName()->isDigit()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $code;
        }
    }

    public function getPhpTemplate(): string
    {
        return parent::getPhpTemplatePrimitive();
    }
}