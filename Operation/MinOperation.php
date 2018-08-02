<?php

namespace Slov\Expression\Operation;
use Slov\Money\Money;

/** Операция выбора минимального значения */
class MinOperation extends Operation
{

    use GetListElementOperationTrait;

    public function getOperationName()
    {
        return new OperationName(OperationName::MIN);
    }

    protected function getListElement(array $list)
    {
        $firstElement = current($list);
        if(is_object($firstElement) && $firstElement instanceof Money)
        {
            return Money::min($list);
        }
        return min($list);
    }
}