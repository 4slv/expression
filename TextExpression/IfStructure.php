<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Expression;

/** Структура условного оператора if */
class IfStructure
{
    /** @var Expression логическое условие */
    protected $condition;

    /** @var Expression выражение в случае если условие истина */
    protected $trueExpression;

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
}