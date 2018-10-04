<?php

namespace Slov\Expression\Operation;

/** Операция определения количества дней в году указанной даты */
class DaysInYearOperation extends InlineFunctionOperation
{
    const INLINE_FUNCTION_OPERATION = 'daysInYear';

    public function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if(($firstOperandType->isNull() && $secondOperandType->isDateInterval())){
            return $this->getTypeNameFactory()->createInt();
        }
        return null;
    }
}