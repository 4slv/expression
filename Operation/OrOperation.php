<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\BooleanType;

/** Логическая операция 'или' */
class OrOperation extends Operation
{
    use BooleanOperationTrait;

    /**
     * @return OperationName
     */
    public function getOperationName()
    {
        return new OperationName(OperationName::OR);
    }

    /**
     * @param BooleanType $firstOperandValue
     * @param BooleanType $secondOperandValue
     * @return bool
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue) : bool
    {
        return $firstOperandValue || $secondOperandValue;
    }
}