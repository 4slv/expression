<?php


namespace Slov\Expression\TextExpression;


use Slov\Expression\ExpressionCache;
use Slov\Expression\Operation\OperationName;
use Slov\Expression\TemplateProcessor\TemplateProcessor;

class SimpleTextExpressionCache extends SimpleTextExpression
{

    /**
     * @var TemplateProcessor
     */
    protected $templateProcessor;

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
        return (new ExpressionCache())
            ->setFunctionList($this->getFunctionList());
    }

}