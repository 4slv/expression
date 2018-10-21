<?php

namespace Slov\Expression;

use Slov\Expression\Expression\ExpressionList;
use Slov\Expression\Statement\ComplexStatementList;
use Slov\Expression\Statement\SimpleStatementList;
use Slov\Expression\TextExpression\VariableList;

/** Контекст выполняемого кода */
class CodeContext
{
    /** @var ComplexStatementList список составных инструкций */
    private $complexStatementList;

    /** @var SimpleStatementList список простых инструкций */
    private $simpleStatementList;

    /** @var ExpressionList список выражений */
    protected $expressionList;

    /** @var VariableList список переменных */
    private $variableList;

    /**
     * @return ComplexStatementList список составных инструкций
     */
    public function getComplexStatementList(): ComplexStatementList
    {
        if(is_null($this->complexStatementList)){
            $this->complexStatementList = new ComplexStatementList();
        }
        return $this->complexStatementList;
    }

    /**
     * @return SimpleStatementList список простых инструкций
     */
    public function getSimpleStatementList(): SimpleStatementList
    {
        if(is_null($this->simpleStatementList)) {
            $this->simpleStatementList = new SimpleStatementList();
        }
        return $this->simpleStatementList;
    }

    /**
     * @return ExpressionList список выражений
     */
    public function getExpressionList(): ExpressionList
    {
        if(is_null($this->expressionList)){
            $this->expressionList = new ExpressionList();
        };
        return $this->expressionList;
    }

    /**
     * @return VariableList список переменных
     */
    public function getVariableList(): VariableList
    {
        if(is_null($this->variableList)){
            $this->variableList = new VariableList();
        }
        return $this->variableList;
    }
}