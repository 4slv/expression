<?php

namespace Slov\Expression\Operation;

use Slov\Expression\ExpressionException;
use Slov\Expression\TextExpression\IfElseStructure;
use Slov\Expression\Type\TypeName;

/** Операция тернарный оператор if-else */
class IfElseOperation extends Operation
{
    /** @var IfElseStructure структура условного оператора */
    private $ifElseStructure;

    /**
     * @return IfElseStructure
     */
    protected function getIfElseStructure(): IfElseStructure
    {
        return $this->ifElseStructure;
    }

    /**
     * @param IfElseStructure $ifElseStructure
     * @return $this
     */
    public function setIfElseStructure(IfElseStructure $ifElseStructure)
    {
        $this->ifElseStructure = $ifElseStructure;
        return $this;
    }

    /**
     * @return TypeName
     * @throws ExpressionException
     */
    public function resolveReturnTypeName()
    {
        $trueTypeName = $this->getIfElseStructure()->getTrueExpression()->getTypeName();
        $falseTypeName = $this->getIfElseStructure()->getFalseExpression()->getTypeName();
        if($trueTypeName->getValue() === $falseTypeName->getValue())
        {
            return $trueTypeName;
        }
        throw new ExpressionException(
            'Operation '. OperationName::IF_ELSE. ' has different result types. '.
            'If condition true: '. $trueTypeName->getValue(). '. '.
            'If condition false: '. $falseTypeName->getValue(). '. '.
            '('. $this->getCode(). ')'
        );
    }

    public function getPhpTemplate(): string
    {
        return $this->getPhpTemplateOperationOnly();
    }

    public function toPhp($code)
    {
        $ifElseStructure = $this->getIfElseStructure();
        $condition = $ifElseStructure->getCondition();
        $trueExpression = $ifElseStructure->getTrueExpression();
        $falseExpression = $ifElseStructure->getFalseExpression();
        $conditionPhp = $condition->toPhp($condition->getCode());
        $trueExpressionPhp = $trueExpression->toPhp($trueExpression->getCode());
        $falseExpressionPhp = $falseExpression->toPhp($falseExpression->getCode());
        return "( ($conditionPhp) ? ($trueExpressionPhp) : ($falseExpressionPhp) )";
    }
}