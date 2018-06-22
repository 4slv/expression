<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\BooleanType;
use Slov\Money\Money;

/** Логическая операция 'не' */
class NotOperation extends Operation
{
    use DigitOperationTrait;

    protected function resolveReturnTypeName()
    {
        return $this->getTypeNameFactory()->createBoolean();
    }

    /**
     * @return OperationName
     */
    public function getOperationName()
    {
        return new OperationName(OperationName::NOT);
    }

    /**
     * @param BooleanType $firstOperandValue
     * @param BooleanType $secondOperandValue
     * @return bool
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue) : bool
    {
        return !(bool)$secondOperandValue;
    }
}