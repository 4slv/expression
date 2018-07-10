<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\BooleanType;

trait BooleanOperationTrait
{
    use OperationTrait;

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isBoolean()
            &&
            $this->getSecondOperandType()->isBoolean()
        ){
            return $this->getTypeNameFactory()->createBoolean();
        }
    }

    /**
     * @return BooleanType нет значения
     */
    protected function createZero()
    {
        return $this->getTypeFactory()->createBoolean()->setValue(false);
    }
}