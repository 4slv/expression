<?php

namespace Slov\Expression\Operation;


/** Остаток от деления */
class RemainderOfDivisionOperation extends Operation
{
    use DigitOperationTrait;

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandTypeName()->isDigit()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $this->getTypeNameFactory()->createInt();
        }
        return null;
    }

    /**
     * @param string $code псевдо-код операции
     * @return string php-код операции
     */
    public function toPhp($code)
    {
        if(
            $this->getFirstOperandTypeName()->isDigit()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $code;
        }
    }
}