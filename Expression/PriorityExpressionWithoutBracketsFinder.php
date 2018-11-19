<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;

/** Поиск подвыражения в скобках */
class PriorityExpressionWithoutBracketsFinder
{
    /**
     * @param CodeContext $codeContext контекст кода
     * @param string $expressionCode псевдокод выражения со скобками
     * @return ExpressionWithoutBrackets выражение без скобок
     * @throws CodeParseException
     */
    public function find(CodeContext $codeContext, string $expressionCode): ExpressionWithoutBrackets
    {
        $expressionWithoutBrackets = preg_match('/\(([^\(\)]+)\)/', $expressionCode, $match)
            ? $this
                ->createExpressionWithoutBrackets()
                ->setCode($match[1])
                ->setUseBrackets(true)
            : $this
                ->createExpressionWithoutBrackets()
                ->setCode($expressionCode)
                ->setUseBrackets(false);
        return $expressionWithoutBrackets->parse($codeContext);
    }

    /**
     * @return ExpressionWithoutBrackets выражение без скобок
     */
    public function createExpressionWithoutBrackets()
    {
        return new ExpressionWithoutBrackets();
    }
}