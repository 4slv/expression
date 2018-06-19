<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\IntType;

/** Операция с числами */
trait DigitOperationTrait
{
    use OperationTrait;

    protected function resolveDigitReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isInt()
            &&
            $this->getSecondOperandType()->isInt()
        ){
            return $this->getTypeNameFactory()->createInt();
        }

        if(
            $this->getFirstOperandType()->isDigit()
            &&
            $this->getSecondOperandType()->isDigit()
        ){
            return $this->getTypeNameFactory()->createFloat();
        }
        return null;
    }

    /**
     * @return IntType ноль
     */
    protected function createZero()
    {
        return $this->getTypeFactory()->createInt()->setValue(0);
    }


}