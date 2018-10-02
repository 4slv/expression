<?php

namespace Slov\Expression\Operation;

/** Операция с деньгами */
trait MoneyOperationTrait
{
    public function toPhpMoney($code = null): string
    {
        $class = get_called_class();
        return constant($class. '::MONEY_OPERATION');
    }
}