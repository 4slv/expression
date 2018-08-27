<?php

namespace Slov\Expression\Operation;

use Slov\Money\Money;

/** Операция преобразования денег к целому числу */
class MoneyOperation extends Operation
{
    use DigitOperationTrait;

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isNull()
            &&
            (
                $this->getSecondOperandType()->isDigit()
            )
        )
            return $this->getTypeNameFactory()->createMoney();

        return null;
    }

    protected function createZero(){
        return $this->getTypeFactory()->createNull();
    }

    /**
     * @return OperationName
     */
    public function getOperationName()
    {
        return OperationName::byValue(OperationName::INT);
    }

    /**
     * @param float $firstOperandValue
     * @param float $secondOperandValue
     * @return Money
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        return Money::create($secondOperandValue);
    }
}