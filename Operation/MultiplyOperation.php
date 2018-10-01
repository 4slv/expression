<?php

namespace Slov\Expression\Operation;

/** Операция умножения */
class MultiplyOperation extends Operation
{
    use DigitOperationTrait;

    /**
     * @return OperationName
     */
    public function getOperationName()
    {
        return OperationName::byValue(OperationName::MULTIPLY);
    }

    protected function resolveReturnTypeName()
    {
        if(
            ($this->getFirstOperandTypeName()->isMoney() && $this->getSecondOperandTypeName()->isDigit())
            ||
            ($this->getFirstOperandTypeName()->isDigit() && $this->getSecondOperandTypeName()->isMoney())
        ){
            return $this->getTypeNameFactory()->createMoney();
        }

        return $this->resolveDigitReturnTypeName();
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