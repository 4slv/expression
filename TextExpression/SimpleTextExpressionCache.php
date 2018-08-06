<?php


namespace Slov\Expression\TextExpression;


use Slov\Expression\ExpressionCache;
use Slov\Expression\Operation\OperationName;

class SimpleTextExpressionCache extends SimpleTextExpression
{

    protected function createOperationByName(OperationName $operationName)
    {
        return $this
            ->getOperationCacheFactory()
            ->create($operationName);
    }

    /**
     * @return ExpressionCache выражение
     */
    protected function createExpression()
    {
        return new ExpressionCache();
    }

}