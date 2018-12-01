<?php

namespace Slov\Expression\Operation;

/** Операция больше */
class GreaterOperation extends CompareOperation
{
    const MONEY_OPERATION = 'more';

    const DATE_INTERVAL_OPERATION = 'greater';

    public function getSign(): string
    {
        return OperationSign::GREATER;
    }
}