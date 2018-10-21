<?php

namespace Slov\Expression\Operation;

class DateOperation extends InlineFunctionOperation
{
    const INLINE_FUNCTION_OPERATION = 'date';

    public function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if(($firstOperandType->isNull() && $secondOperandType->isDateInterval())){
            return $this->getTypeNameFactory()->createDateTime();
        }
        return null;
    }
}