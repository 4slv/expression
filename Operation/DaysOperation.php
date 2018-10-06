<?php

namespace Slov\Expression\Operation;

class DaysOperation extends InlineFunctionOperation
{
    const INLINE_FUNCTION_OPERATION = 'days';

    public function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if(($firstOperandType->isNull() && $secondOperandType->isDateInterval())){
            return $this->getTypeNameFactory()->createInt();
        }
        if(($firstOperandType->isNull() && $secondOperandType->isInt())){
            return $this->getTypeNameFactory()->createDateInterval();
        }
        return null;
    }

    public function getPhpTemplate(): string
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if(
            ($firstOperandType->isNull() && $secondOperandType->isInt())
            ||
            ($firstOperandType->isNull() && $secondOperandType->isDateInterval())
        ){
            return $this->getPhpTemplateInlineFunction();
        }
    }
}