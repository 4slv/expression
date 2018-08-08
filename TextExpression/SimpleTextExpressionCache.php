<?php


namespace Slov\Expression\TextExpression;


use Slov\Expression\ExpressionCache;
use  Slov\Expression\OperationCache\AssignOperation;
use Slov\Expression\Operation\OperationName;
use Slov\Expression\TemplateProcessor\TemplateProcessor;
use Slov\Expression\Type\VariableType;

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
            ->setFunctionList($this->getFunctionList())
            ->setVariableList($this->getVariableList());
    }

}