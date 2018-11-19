<?php


namespace Slov\Expression\Operation;

/** Доступ к регулярным выражениям знаков операции */
trait OperationSignRegexpAccessor
{
    /**
     * @return string[] асоциативный массив: название операции => регулярное выражение
     */
    protected function getOperationSignRegexpList()
    {
        return OperationSignRegexp::getConstants();
    }
}