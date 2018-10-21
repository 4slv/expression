<?php

namespace Slov\Expression\Operation;


/** Операция преобразования числа с плавающей точкой к целому числу */
class IntOperation extends InlineFunctionOperation
{
    const INLINE_FUNCTION_OPERATION = 'int';

    public function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if(
            ($firstOperandType->isNull() && $secondOperandType->isMoney())
            ||
            ($firstOperandType->isNull() && $secondOperandType->isDigit())
        ){
            return $this->getTypeNameFactory()->createInt();
        }
        return null;
    }
}