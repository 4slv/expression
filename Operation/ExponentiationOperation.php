<?php

namespace Slov\Expression\Operation;

/** Операция возведения в степень */
class ExponentiationOperation extends Operation
{
    use DigitOperationTrait
    {
        DigitOperationTrait::resolveDigitReturnTypeName as resolveReturnTypeName;
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
}