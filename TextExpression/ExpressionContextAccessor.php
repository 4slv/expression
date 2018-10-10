<?php

namespace Slov\Expression\TextExpression;


trait ExpressionContextAccessor
{
    /** @var ExpressionContext контекст выражения */
    protected $expressionContext;

    /**
     * @return ExpressionContext контекст выражения
     */
    public function getExpressionContext(): ExpressionContext
    {
        if(is_null($this->expressionContext))
        {
            $this->expressionContext = new ExpressionContext();
            $expressionList = new ExpressionList();
            $variableList = new VariableList();
            $this->expressionContext->setExpressionList($expressionList);
            $this->expressionContext->setVariableList($variableList);
        }
        return $this->expressionContext;
    }

    /**
     * @param ExpressionContext $expressionContext контекст выражения
     * @return $this
     */
    public function setExpressionContext(ExpressionContext $expressionContext)
    {
        $this->expressionContext = $expressionContext;
        return $this;
    }

    /**
     * @return ExpressionList список выражений
     */
    public function getExpressionList()
    {
        return $this->getExpressionContext()->getExpressionList();
    }

    /**
     * @return VariableList список переменных
     */
    public function getVariableList(): VariableList
    {
        return $this->getExpressionContext()->getVariableList();
    }
}