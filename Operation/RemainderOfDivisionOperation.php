<?php

namespace Slov\Expression\Operation;
use Slov\Expression\CalculationException;


/** Остаток от деления */
class RemainderOfDivisionOperation extends Operation
{
    use DigitOperationTrait;

    public function getOperationName()
    {
        return OperationName::byValue(OperationName::REMAINDER_OF_DIVISION);
    }

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isDigit()
            &&
            $this->getSecondOperandType()->isDigit()
        ){
            return $this->getTypeNameFactory()->createInt();
        }
        return null;
    }

    /**
     * @param float|int $firstOperandValue
     * @param float|int $secondOperandValue
     * @return float|int
     * @throws CalculationException
     */
    public function calculateValues($firstOperandValue, $secondOperandValue)
    {
        if(is_numeric($firstOperandValue) && is_numeric($secondOperandValue)){
            return $firstOperandValue % $secondOperandValue;
        }
        $this->throwOperationException();
        return null;
    }
}