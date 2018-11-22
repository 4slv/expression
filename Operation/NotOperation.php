<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\BooleanType;

/** Логическая операция 'не' */
class NotOperation extends Operation
{
    use BooleanOperationTrait;

    /**
     * @return OperationName
     */
    public function getOperationName()
    {
        return OperationName::byValue(OperationName::NOT);
    }

    /**
     * @param BooleanType $firstOperandValue
     * @param BooleanType $secondOperandValue
     * @return bool
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue) : bool
    {
        return !$secondOperandValue;
    }
}