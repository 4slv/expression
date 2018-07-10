<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\DateIntervalType;
use Slov\Money\Money;
use DateInterval;
use DateTime;

/** Операция сравнения 'больше или равно' */
class GreaterOrEqualOperation extends Operation
{
    use CompareOperationTrait;

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