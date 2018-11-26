<?php

namespace Slov\Expression\Expression;

/** Доступ к определению выражения */
trait ExpressionResolverAccessor
{
    /** @var ExpressionResolver определение выражения */
    protected $expressionResolver;

    /**
     * @return ExpressionResolver
     */
    public function getExpressionResolver(): ExpressionResolver
    {
        if(is_null($this->expressionResolver))
        {
            $this->expressionResolver = new ExpressionResolver();
        }
        return $this->expressionResolver;
    }


}