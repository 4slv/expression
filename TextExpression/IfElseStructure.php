<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Expression;
use Slov\Expression\Type\BooleanType;
use Slov\Expression\Type\Type;

/** Структура условного оператора */
class IfElseStructure
{
    /** @var Expression логическое условие */
    protected $condition;

    /** @var Expression результат в случае если условие истина */
    protected $trueResult;

    /** @var Expression результат в случае если условие ложь */
    protected $falseResult;

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
     * @return Expression результат в случае если условие истина
     */
    public function getTrueResult()
    {
        return $this->trueResult;
    }

    /**
     * @param Expression $trueResult результат в случае если условие истина
     * @return $this
     */
    public function setTrueResult($trueResult)
    {
        $this->trueResult = $trueResult;
        return $this;
    }

    /**
     * @return Expression результат в случае если условие ложь
     */
    public function getFalseResult()
    {
        return $this->falseResult;
    }

    /**
     * @param Expression $falseResult результат в случае если условие ложь
     * @return $this
     */
    public function setFalseResult($falseResult)
    {
        $this->falseResult = $falseResult;
        return $this;
    }
}