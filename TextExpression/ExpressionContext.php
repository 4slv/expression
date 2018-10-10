<?php

namespace Slov\Expression\TextExpression;

/** Контекст выполнения выражения */
class ExpressionContext
{
    /** @var ExpressionList список выражений */
    protected $expressionList;

    /** @var VariableList список переменных */
    private $variableList;

    /**
     * @return ExpressionList список выражений
     */
    public function getExpressionList(): ExpressionList
    {
        return $this->expressionList;
    }

    /**
     * @param ExpressionList $expressionList список выражений
     * @return $this
     */
    public function setExpressionList(ExpressionList $expressionList)
    {
        $this->expressionList = $expressionList;
        return $this;
    }

    /**
     * @return VariableList список переменных
     */
    public function getVariableList(): VariableList
    {
        return $this->variableList;
    }

    /**
     * @param VariableList $variableList список переменных
     * @return $this
     */
    public function setVariableList(VariableList $variableList)
    {
        $this->variableList = $variableList;
        return $this;
    }
}