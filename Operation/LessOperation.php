<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\DateIntervalType;
use Slov\Money\Money;
use DateInterval;
use DateTime;

/** Операция сравнения 'меньше' */
class LessOperation extends Operation
{
    use CompareOperationTrait;

    /**
     * @return OperationName
     */
    public function getOperationName()
    {
        return OperationName::byValue(OperationName::LESS);
    }

    /**
     * Возвращает true - если первый операнд меньше второго, иначе - false
     * @param float|int|Money|DateTime|DateInterval $firstOperandValue
     * @param float|int|Money|DateTime|DateInterval $secondOperandValue
     * @return bool
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue) : bool
    {
        if($firstOperandValue instanceof DateInterval && $secondOperandValue instanceof DateInterval){
            return DateIntervalType::less($firstOperandValue, $secondOperandValue);
        }

        if($firstOperandValue instanceof DateTime && $secondOperandValue instanceof DateTime){
            return $firstOperandValue < $secondOperandValue;
        }

        if($firstOperandValue instanceof Money && $secondOperandValue instanceof Money){
            return $firstOperandValue->less($secondOperandValue);
        }

        if(is_numeric($firstOperandValue) && is_numeric($secondOperandValue)){
            return $firstOperandValue < $secondOperandValue;
        }

        return false;
    }
}