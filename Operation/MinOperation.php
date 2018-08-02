<?php

namespace Slov\Expression\Operation;

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
        return min($list);
    }
}