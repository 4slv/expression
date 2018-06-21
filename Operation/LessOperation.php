<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\DateIntervalType;
use Slov\Money\Money;
use DateInterval;
use DateTime;

/** Операция сравнения 'меньше' */
class LessOperation extends Operation
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
        return new OperationName(OperationName::LESS);
    }

    /**
     * Возвращает true - если первый операнд меньше второго, иначе - false
     * @param float|int|Money|DateTime|DateInterval $firstOperandValue
     * @param float|int|Money|DateTime|DateInterval $secondOperandValue
     * @return bool
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue) : bool
    {
        $boolVal = false;

        if($firstOperandValue instanceof DateInterval && $secondOperandValue instanceof DateInterval){
            $boolVal = DateIntervalType::less($firstOperandValue, $secondOperandValue);
        }

        if($firstOperandValue instanceof DateTime && $secondOperandValue instanceof DateTime){
            $boolVal = $firstOperandValue < $secondOperandValue;
        }

        if($firstOperandValue instanceof Money && $secondOperandValue instanceof Money){
            $boolVal = $firstOperandValue->less($secondOperandValue);
        }

        if(is_numeric($firstOperandValue) && is_numeric($secondOperandValue)){
            $boolVal = $firstOperandValue < $secondOperandValue;
        }

        return $boolVal;
    }
}