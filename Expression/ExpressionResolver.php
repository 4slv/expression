<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Code\CodeAccessor;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\CodePartFactory;

/** Определение выражения */
class ExpressionResolver
{
    use CodeAccessor;
    use CodePartFactory;

    public function resolve(CodeContext $codeContext): Expression
    {
        $assignRegexp = AssignExpression::EXPRESSION_CODE_REGEXP;
        $expression = preg_match($assignRegexp, $expressionCode)
            ? $this->createAssignExpression()
            : $this->createExpressionWithBrackets();
        return $expression
            ->setCode($expressionCode)
            ->parse($codeContext);
    }
}