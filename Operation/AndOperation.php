<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\BooleanType;

/** Логическая операция 'и' */
class AndOperation extends Operation
{
    use BooleanOperationTrait;

    /**
     * @return OperationName
     */
    public function getOperationName()
    {
        return new OperationName(OperationName::AND);
    }

    /**
     * @param BooleanType $firstOperandValue
     * @param BooleanType $secondOperandValue
     * @return bool
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue) : bool
    {
        return $firstOperandValue && $secondOperandValue;
    }
}