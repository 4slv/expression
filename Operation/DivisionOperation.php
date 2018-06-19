<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CalculationException;
use Slov\Money\Money;

/** Операция деления */
class DivisionOperation extends Operation
{

    use DigitOperationTrait;

    public function getOperationName()
    {
        return new OperationName(OperationName::DIVISION);
    }

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isMoney()
            &&
            $this->getSecondOperandType()->isDigit()
        ){
            return $this->getTypeNameFactory()->createMoney();
        }

        if(
            $this->getFirstOperandType()->isDigit()
            &&
            $this->getSecondOperandType()->isDigit()
        ){
            return $this->getTypeNameFactory()->createFloat();
        }
        return null;
    }

    /**
     * @param float|int|Money $firstOperandValue значение первого операнда
     * @param float|int|Money $secondOperandValue значение второго операнда
     * @return float|int|Money
     * @throws CalculationException
     */
    public function calculateValues($firstOperandValue, $secondOperandValue)
    {
        if(is_numeric($firstOperandValue) && is_numeric($secondOperandValue)){
            return $firstOperandValue / $secondOperandValue;
        }
        if($firstOperandValue instanceof Money && is_numeric($secondOperandValue)){
            return $firstOperandValue->div($secondOperandValue);
        }
        $this->throwOperationException();
        return null;
    }
}