<?php

namespace Slov\Expression\Expression;


use Slov\Expression\CodeAccessor;
use Slov\Expression\CodeContext;

/** Парсер выражений */
class ExpressionParser
{
    use CodeAccessor;

    const SUB_EXPRESSION_REGEXP = '/\(([^\(\)]+)\)/';

    /** Разбор псевдо кода
     * @param CodeContext $codeContext контекст кода
     */
    public function parse(CodeContext $codeContext)
    {
        $code = $this->getCode();
        $this->replaceCode($code, $codeContext);
    }

    /**
     * @param string $code псевдо код
     * @param CodeContext $codeContext
     * @return string
     */
    public function replaceCode($code, CodeContext $codeContext)
    {
        $expressionCodeList = $this->getExpressionCodeList($code);
        if (count($expressionCodeList) === 0) {
            return $code;
        } else {
            foreach ($expressionCodeList as $position => $expressionCode)
            {
                $expression = $this->createExpression($expressionCode);
                $expressionLabel = $codeContext
                    ->getExpressionList()
                    ->append($expression);


                return $expressionLabel;
            }
        }
    }

    /**
     * @param string $code псевдо код
     * @return Expression выражение
     */
    protected function createExpression($code)
    {
        $expression = new Expression();
        return $expression->setCode($code);
    }

        /**
     * @param string $code псевдо код
     * @return string[] список кода подвыражений без скобок
     */
    protected function getExpressionCodeList($code)
    {
        preg_match_all(self::SUB_EXPRESSION_REGEXP, $code, $match);
        return $match[1];
    }
}