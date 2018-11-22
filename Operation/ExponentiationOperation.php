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
     * @return OperationName
     */
    public function getOperationName()
    {
        return OperationName::byValue(OperationName::EXPONENTIATION);
    }

    /**
     * @param float|int $firstOperandValue
     * @param float|int $secondOperandValue
     * @return float|int
     */
    public function calculateValues($firstOperandValue, $secondOperandValue)
    {
        return $firstOperandValue ** $secondOperandValue;
    }
}