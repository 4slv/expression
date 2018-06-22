<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\DateIntervalType;
use Slov\Expression\Type\IntType;
use Slov\Expression\Type\Type;
use Slov\Money\Money;
use DateInterval;
use DateTime;

/** Операция преобразования числа с плавающей точкой к целому числу */
class IntOperation extends Operation
{
    use DigitOperationTrait;

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isNull()
            &&
            $this->getSecondOperandType()->isDigit()
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
        return new OperationName(OperationName::INT);
    }

    /**
     * @param float $firstOperandValue
     * @param float $secondOperandValue
     * @return IntType
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        return (int)$secondOperandValue;
    }
}