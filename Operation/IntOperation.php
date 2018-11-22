<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\IntType;
use Slov\Money\Money;

/** Операция преобразования числа с плавающей точкой к целому числу */
class IntOperation extends Operation
{
    use DigitOperationTrait;

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isNull()
            &&
            (
                $this->getSecondOperandType()->isDigit()
                ||
                $this->getSecondOperandType()->isMoney()
            )
        )
            return $this->getTypeNameFactory()->createInt();

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
     * @return int
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        if(is_object($secondOperandValue) && $secondOperandValue instanceof Money){
            return $secondOperandValue->getAmount();
        }
        return (int)$secondOperandValue;
    }
}