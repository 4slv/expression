<?php

namespace Slov\Expression\Operation;

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
        return max($list);
    }
}