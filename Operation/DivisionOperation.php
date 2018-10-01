<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CalculationException;

/** Операция деления */
class DivisionOperation extends Operation
{

    use DigitOperationTrait;

    public function getOperationName()
    {
        return OperationName::byValue(OperationName::DIVISION);
    }

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandTypeName()->isMoney()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $this->getTypeNameFactory()->createMoney();
        }

        if(
            $this->getFirstOperandTypeName()->isDigit()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $this->getTypeNameFactory()->createFloat();
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