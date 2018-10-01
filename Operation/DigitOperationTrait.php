<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Expression;

/** Операция с числами */
trait DigitOperationTrait
{
    use OperationTrait;

    protected function resolveDigitReturnTypeName()
    {
        if(
            $this->getFirstOperandTypeName()->isInt()
            &&
            $this->getSecondOperandTypeName()->isInt()
        ){
            return $this->getTypeNameFactory()->createInt();
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

    public function getPhpTemplate(): string
    {
        if(
            $this->getFirstOperandTypeName()->isDigit()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){

                return implode(
                    ' ',
                    [
                        Expression::FIRST_OPERAND,
                        Expression::OPERATION,
                        Expression::SECOND_OPERAND
                    ]
                );
        }
        return null;
    }

}