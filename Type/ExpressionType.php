<?php

namespace Slov\Expression\Type;


use Slov\Expression\TextExpression\ExpressionList;

class ExpressionType extends Type
{
    /** @var ExpressionList список выражений */
    protected $expressionList;

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

    public function toPhp($code)
    {
        return $this
            ->getExpressionList()
            ->get($code)
            ->toPhp($code);
    }
}