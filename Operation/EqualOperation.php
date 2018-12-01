<?php

namespace Slov\Expression\Operation;

/** Операция сравнения */
class EqualOperation extends CompareOperation
{
    const MONEY_OPERATION = 'equal';

    const DATE_INTERVAL_OPERATION = 'equal';

    public function getSign(): string
    {
        return OperationSign::EQUAL;
    }
}