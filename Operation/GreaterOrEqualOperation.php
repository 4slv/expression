<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\DateIntervalType;
use Slov\Money\Money;
use DateInterval;
use DateTime;

/** Операция сравнения 'больше или равно' */
class GreaterOrEqualOperation extends Operation
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
        return new OperationName(OperationName::GREATER_OR_EQUALS);
    }

    /**
     * @param float|int|Money|DateTime|DateInterval $firstOperandValue
     * @param float|int|Money|DateTime|DateInterval $secondOperandValue
     * @return bool
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue) : bool
    {
        if($firstOperandValue instanceof DateInterval && $secondOperandValue instanceof DateInterval){
            return DateIntervalType::greaterOrEqual($firstOperandValue, $secondOperandValue);
        }

        if($firstOperandValue instanceof DateTime && $secondOperandValue instanceof DateTime){
            return $firstOperandValue >= $secondOperandValue;
        }

        if($firstOperandValue instanceof Money && $secondOperandValue instanceof Money){
            return $firstOperandValue->equalOrMore($secondOperandValue);
        }

        if(is_numeric($firstOperandValue) && is_numeric($secondOperandValue)){
            return $firstOperandValue >= $secondOperandValue;
        }

        return false;
    }
}