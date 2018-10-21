<?php

namespace Slov\Expression\Operation;

/** Цифровая операция */
abstract class DigitOperation extends Operation
{
    public function resolveDigitReturnTypeName()
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
}