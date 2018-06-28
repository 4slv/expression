<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Type\BooleanType;

trait CompareOperationTrait
{
    use OperationTrait;

    /**
     * @return BooleanType нет значения
     */
    protected function createZero()
    {
        return $this->getTypeFactory()->createBoolean()->setValue(false);
    }

    protected function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandType();
        $secondOperandType = $this->getSecondOperandType();

        if(
            ($firstOperandType->isMoney() && $secondOperandType->isMoney())
            ||
            $firstOperandType->isDateInterval() && $secondOperandType->isDateInterval()
            ||
            $firstOperandType->isDateTime() && $secondOperandType->isDateTime()
            ||
            $firstOperandType->isDigit() && $secondOperandType->isDigit()
        ){
            return $this->getTypeNameFactory()->createBoolean();
        }
    }
}