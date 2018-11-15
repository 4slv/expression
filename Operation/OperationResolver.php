<?php

namespace Slov\Expression\Operation;

/** Расознаватель операции */
class OperationResolver
{
    /** Распознать операцию
     * @param string $code псевдо код операции */
    public function resolve($code)
    {
        foreach ($this->getSignList() as $operationName => $signRegexp)
        {
            $operationRegexp = '/^(.*)('. $signRegexp. ')(.*)$/';
            if(preg_match($operationRegexp, $code)){

            }
        }
    }

    /**
     * @return string[] асоциативный массив: название операции => регулярное выражение
     */
    protected function getSignList()
    {
        return OperationSignRegexp::getConstants();
    }
}