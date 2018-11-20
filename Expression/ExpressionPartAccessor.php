<?php

namespace Slov\Expression\Expression;

/** Доступ к части выражения */
trait ExpressionPartAccessor
{
    /** @var ExpressionPart часть выражения */
    protected $expressionPart;

    /**
     * @return ExpressionPart часть выражения
     */
    public function getExpressionPart(): ExpressionPart
    {
        return $this->expressionPart;
    }

    /**
     * @param ExpressionPart $expressionPart часть выражения
     * @return $this
     */
    public function setExpressionPart(ExpressionPart $expressionPart)
    {
        $this->expressionPart = $expressionPart;
        return $this;
    }
}