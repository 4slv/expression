<?php

namespace Slov\Expression\Operation;


/** Операция преобразования указанной даты в дату первого числа года */
class FirstYearDayOperation extends InlineFunctionOperation
{
    const INLINE_FUNCTION_OPERATION = 'firstYearDay';

    public function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if(($firstOperandType->isNull() && $secondOperandType->isDateTime())){
            return $this->getTypeNameFactory()->createDateTime();
        }
        return null;
    }
}