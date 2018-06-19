<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\DateIntervalType;
use Slov\Money\Money;
use DateInterval;
use DateTime;

/** Операция сложения */
class AddOperation extends Operation
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
        return new OperationName(OperationName::ADD);
    }

    /**
     * @param float|int|Money|DateTime|DateInterval $firstOperandValue
     * @param float|int|Money|DateTime|DateInterval $secondOperandValue
     * @return float|int|Money|DateTime|DateInterval
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        if($firstOperandValue instanceof DateInterval && $secondOperandValue instanceof DateInterval){
            return DateIntervalType::add($firstOperandValue, $secondOperandValue);
        }
        if($firstOperandValue instanceof DateTime && $secondOperandValue instanceof DateInterval)
        {
            return $firstOperandValue->add($secondOperandValue);
        }
        if($firstOperandValue instanceof DateInterval && $secondOperandValue instanceof DateTime)
        {
            return $secondOperandValue->add($firstOperandValue);
        }
        if($firstOperandValue instanceof Money && $secondOperandValue instanceof Money){
            return $firstOperandValue->add($secondOperandValue);
        }
        if(is_numeric($firstOperandValue) && is_numeric($secondOperandValue)){
            return $firstOperandValue + $secondOperandValue;
        }

        return null;
    }
}