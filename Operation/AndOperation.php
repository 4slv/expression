<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\BooleanType;
use Slov\Money\Money;

/** Логическая операция 'и' */
class AndOperation extends Operation
{
    use DigitOperationTrait;

    protected function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandType();
        $secondOperandType = $this->getSecondOperandType();

        if($firstOperandType->isMoney() && $secondOperandType->isMoney()){
            return $this->getTypeNameFactory()->createMoney();
        }

        if($firstOperandType->isDateInterval() && $secondOperandType->isDateInterval()){
            return $this->getTypeNameFactory()->createDateInterval();
        }

        if($firstOperandType->isDateTime() && $secondOperandType->isDateTime()){
            return $this->getTypeNameFactory()->createDateTime();
        }

        if(
            ($firstOperandType->isDateTime() && $secondOperandType->isDateInterval())
            ||
            ($firstOperandType->isDateInterval() && $secondOperandType->isDateTime())
        ){
            return $this->getTypeNameFactory()->createDateTime();
        }

        return $this->resolveDigitReturnTypeName();
    }

    /**
     * @return OperationName
     */
    public function getOperationName()
    {
        return new OperationName(OperationName::AND);
    }

    /**
     * @param BooleanType $firstOperandValue
     * @param BooleanType $secondOperandValue
     * @return bool
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue) : bool
    {
        return $firstOperandValue && $secondOperandValue;
    }
}