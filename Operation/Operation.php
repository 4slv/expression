<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Calculation;
use Slov\Expression\Type\Type;
use Slov\Expression\Type\TypeName;
use Slov\Money\Money;

/** Операция с типами */
abstract class Operation implements Calculation {

    use OperationTrait;

    /** @return OperationName название операции */
    abstract public function getOperationName();

    /** @return TypeName название типа */
    abstract protected function resolveReturnTypeName();

    /** @return Type тип заменяющий отсутствующее значение */
    abstract protected function createZero();

    /**
     * @param int|float|Money $firstOperandValue значение первого операнда
     * @param int|float|Money $secondOperandValue значение второго операнда
     * @return int|float|Money рассчётное значение результата операции
     */
    abstract protected function calculateValues($firstOperandValue, $secondOperandValue);


}