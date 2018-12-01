<?php

namespace Slov\Expression\Operation;

/** Операция меньше или равно */
class LessOrEqualOperation extends CompareOperation
{
    const MONEY_OPERATION = 'equalOrLess';

    const DATE_INTERVAL_OPERATION = 'lessOrEqual';

    public function getSign(): string
    {
        return OperationSign::LESS_OR_EQUAL;
    }
}