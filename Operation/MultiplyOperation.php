<?php

namespace Slov\Expression\Operation;

use Slov\Money\Money;

/** Операция умножения */
class MultiplyOperation extends Operation
{
    use DigitOperationTrait;

    /**
     * @return OperationName
     */
    public function getOperationName()
    {
        return new OperationName(OperationName::MULTIPLY);
    }

    protected function resolveReturnTypeName()
    {
        if(
            ($this->getFirstOperandType()->isMoney() && $this->getSecondOperandType()->isDigit())
            ||
            ($this->getFirstOperandType()->isDigit() && $this->getSecondOperandType()->isMoney())
        ){
            return $this->getTypeNameFactory()->createMoney();
        }

        return $this->resolveDigitReturnTypeName();
    }

    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        if(is_numeric($firstOperandValue) && is_numeric($secondOperandValue)){
            return $firstOperandValue * $secondOperandValue;
        }

        if($firstOperandValue instanceof Money && is_numeric($secondOperandValue))
        {
            return $firstOperandValue->mul($secondOperandValue);
        }

        if(is_numeric($firstOperandValue) && $secondOperandValue instanceof Money){
            return $secondOperandValue->mul($firstOperandValue);
        }
        $this->throwOperationException();
        return null;
    }
}