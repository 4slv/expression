<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;


/** Выражение без скобок */
class ExpressionWithoutBrackets extends Expression
{
    /** @var FirstExpressionPartResolver определение первой части выражения */
    protected $firstExpressionPartResolver;

    /**
     * @return FirstExpressionPartResolver определение первой части выражения
     */
    public function getFirstExpressionPartResolver(): FirstExpressionPartResolver
    {
        if(is_null($this->firstExpressionPartResolver))
        {
            $this->firstExpressionPartResolver = new FirstExpressionPartResolver();
        }
        return $this->firstExpressionPartResolver;
    }

    protected function defineExpressionPart(CodeContext $codeContext): ExpressionPart
    {
        $expressionCode = $this->getCode();
        $expressionPart = null;
        while ($codeContext->checkLabelIsExpressionPart($expressionCode) === false)
        {
            $expressionPart = $this
                ->getFirstExpressionPartResolver()
                ->resolve($codeContext, $expressionCode);

            $expressionCode = $this->stringReplaceOnce(
                $expressionPart->getCode(),
                $expressionPart->getLabel(),
                $expressionCode
            );
        }
        return $expressionPart;
    }
}