<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;

/** Операция не равно */
class NotEqualOperation extends CompareOperation
{
    const MONEY_OPERATION = 'equal';

    const DATE_INTERVAL_OPERATION = 'equal';

    public function getSign(): string
    {
        return OperationSign::EQUAL;
    }

    public function toPhp(CodeContext $codeContext): string
    {
        $equalCode = parent::toPhp($codeContext);
        return "!($equalCode)";
    }
}