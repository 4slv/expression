<?php

namespace Slov\Expression\Operation;
use Slov\Money\Money;

/** Операция выбора максимального значения */
class MaxOperation extends Operation
{

    use GetListElementOperationTrait;

    public function getOperationName()
    {
        return new OperationName(OperationName::MAX);
    }

    protected function getListElement(array $list)
    {
        $firstElement = current($list);
        if(is_object($firstElement) && $firstElement instanceof Money)
        {
            return Money::max($list);
        }
        return max($list);
    }
}