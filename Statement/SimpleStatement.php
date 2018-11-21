<?php

namespace Slov\Expression\Statement;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePart;
use Slov\Expression\Expression\AssignExpression;
use Slov\Expression\Expression\Expression;
use Slov\Expression\Expression\ExpressionAccessor;

/** Простая инструкция */
class SimpleStatement extends CodePart
{
    use ExpressionAccessor;

    const STATEMENT_REGEXP = '/([^;]*);/';

    const STATEMENT_SEPARATOR = ';';

    /** Определить операцию выражения
     * @param CodeContext $codeContext контекст кода
     * @return Expression выражение
     * @throws CodeParseException */
    protected function defineExpression(CodeContext $codeContext): Expression
    {
        $statementCode = $this->getCode();
        if(preg_match(self::STATEMENT_REGEXP, $statementCode, $match)){
            $expressionCode = trim($match[1]);
            $assignRegexp = AssignExpression::EXPRESSION_CODE_REGEXP;
            $expression = preg_match($assignRegexp, $expressionCode)
                ? $this->createAssignExpression()
                : $this->createExpressionWithBrackets();
            return $expression
                ->setCode($expressionCode)
                ->parse($codeContext);
        }
        throw new CodeParseException($statementCode. ':: code is not simple statement');
    }

    public function parse(CodeContext $codeContext)
    {
        $this->setExpression($this->defineExpression($codeContext));
        return parent::parse($codeContext);
    }

    /**
     * @param CodeContext $codeContext контекст кода
     * @return SimpleStatementList список простых инструкций
     */
    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getSimpleStatementList();
    }

    public function toPhp(CodeContext $codeContext): string
    {
        return $this->getExpression()->toPhp($codeContext). self::STATEMENT_SEPARATOR;
    }
}