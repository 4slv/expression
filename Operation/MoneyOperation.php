<?php

namespace Slov\Expression\Operation;

/** Операция преобразования числа к деньгам */
class MoneyOperation extends InlineFunctionOperation
{
    const INLINE_FUNCTION_OPERATION = 'money';

    public function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if($firstOperandType->isNull() && $secondOperandType->isDigit()){
            return $this->getTypeNameFactory()->createInt();
        }
        return null;
    }
}