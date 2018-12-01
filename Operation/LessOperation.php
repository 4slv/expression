<?php

namespace Slov\Expression\Operation;

/** Операция меньше */
class LessOperation extends CompareOperation
{
    const MONEY_OPERATION = 'less';

    const DATE_INTERVAL_OPERATION = 'less';

    public function getSign(): string
    {
        return OperationSign::LESS;
    }
}