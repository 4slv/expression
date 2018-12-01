<?php

namespace Slov\Expression\Operation;

/** Операция больше или равно */
class GreaterOrEqualOperation extends CompareOperation
{
    const MONEY_OPERATION = 'equalOrMore';

    const DATE_INTERVAL_OPERATION = 'greaterOrEqual';

    public function getSign(): string
    {
        return OperationSign::GREATER_OR_EQUAL;
    }
}