<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Expression;

/** Структура тернарного оператора if-else */
class IfElseStructure
{
    /** @var Expression логическое условие */
    protected $condition;

    /** @var Expression выражение в случае если условие истина */
    protected $trueExpression;

    /** @var Expression выражение в случае если условие ложь */
    protected $falseExpression;

    /**
     * @return Expression логическое условие
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param Expression $condition логическое условие
     * @return $this
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return Expression выражение в случае если условие истина
     */
    public function getTrueExpression()
    {
        return $this->trueExpression;
    }

    /**
     * @param Expression $trueExpression выражение в случае если условие истина
     * @return $this
     */
    public function setTrueExpression($trueExpression)
    {
        $this->trueExpression = $trueExpression;
        return $this;
    }

    /**
     * @return Expression выражение в случае если условие ложь
     */
    public function getFalseExpression()
    {
        return $this->falseExpression;
    }

    /**
     * @param Expression $falseExpression выражение в случае если условие ложь
     * @return $this
     */
    public function setFalseExpression($falseExpression)
    {
        $this->falseExpression = $falseExpression;
        return $this;
    }
}