<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CalculationException;
use Slov\Expression\Type\DateIntervalType;
use Slov\Money\Money;
use DateTime;
use DateInterval;

/** Операция вычитания */
class SubtractionOperation extends Operation
{
    use DigitOperationTrait;

    protected function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandType();
        $secondOperandType = $this->getSecondOperandType();

        if($firstOperandType->isMoney() && $secondOperandType->isMoney()){
            return $this->getTypeNameFactory()->createMoney();
        }

        if(
            ($firstOperandType->isDateInterval() && $secondOperandType->isDateInterval())
            ||
            ($firstOperandType->isDateTime() && $secondOperandType->isDateTime())
        ){
            return $this->getTypeNameFactory()->createDateInterval();
        }

        if($firstOperandType->isDateTime() && $secondOperandType->isDateInterval()){
            return $this->getTypeNameFactory()->createDateTime();
        }

        return $this->resolveDigitReturnTypeName();
    }

    public function getOperationName()
    {
        return OperationName::byValue(OperationName::SUBTRACTION);
    }

    /**
     * @param float|int|Money|DateTime|DateInterval $firstOperandValue
     * @param float|int|Money|DateTime|DateInterval $secondOperandValue
     * @return float|int|Money|DateTime|DateInterval
     * @throws CalculationException
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        if($firstOperandValue instanceof DateInterval && $secondOperandValue instanceof DateInterval){
            return DateIntervalType::sub($firstOperandValue, $secondOperandValue);
        }
        if($firstOperandValue instanceof DateTime && $secondOperandValue instanceof DateInterval)
        {
            return $firstOperandValue->sub($secondOperandValue);
        }
        if($firstOperandValue instanceof DateTime && $secondOperandValue instanceof DateTime)
        {
            return $secondOperandValue->diff($firstOperandValue);
        }
        if(is_numeric($firstOperandValue) && is_numeric($secondOperandValue)){
            return $firstOperandValue - $secondOperandValue;
        }
        if($firstOperandValue instanceof Money && $secondOperandValue instanceof Money){
            return $firstOperandValue->sub($secondOperandValue);
        }
        $this->throwOperationException();
        return null;
    }
}