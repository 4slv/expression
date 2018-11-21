<?php

namespace Slov\Expression\Expression;

/** Доступ к выражению */
trait ExpressionAccessor
{
    /** @var Expression выражение */
    protected $expression;

    /**
     * @return Expression выражение
     */
    public function getExpression(): Expression
    {
        return $this->expression;
    }

    /**
     * @param Expression $expression выражение
     * @return $this
     */
    public function setExpression(Expression $expression)
    {
        $this->expression = $expression;
        return $this;
    }
}