<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Expression\ExpressionException;

class TextExpression extends SimpleTextExpression
{
    const SUB_EXPRESSION_REGEXP = '/\(([^\(\)]+)\)/';

    protected function toPhpWithoutComments($code, $codeContext)
    {
        $simpleTextExpressionList = $this->getSimpleTextExpressionList($code);
        $simpleTextExpressionBracketedList = $this->getSimpleTextExpressionBracketedList($code);
        if (count($simpleTextExpressionList) === 0) {
            return $this
                ->createSimpleTextExpression()
                ->toPhp($code, $codeContext);
        } else {
            foreach($simpleTextExpressionList as $position => $simpleTextExpression) {
                $simpleTextExpressionBracketed = $simpleTextExpressionBracketedList[$position];
                $expressionTextWithLabel = $this->replaceExpressionText(
                    $code, $simpleTextExpressionBracketed
                );
                return $this->toPhpWithoutComments(
                    $expressionTextWithLabel,
                    $codeContext
                );
            }
        }
        return null;
    }

    /**
     * @param string $code псевдо код
     * @param string $simpleTextExpressionBracketed подвыражение в текстовом представлении (со скобками)
     * @return string
     * @throws ExpressionException
     */
    private function replaceExpressionText($code, $simpleTextExpressionBracketed)
    {
        $simpleCode = $this->removeBracket($simpleTextExpressionBracketed);
        $expression = $this
            ->createSimpleTextExpression()
            ->toExpression($simpleCode);
        $expression->setUseBrackets(true)->init();
        $expressionLabel = $this->appendExpression($expression);
        $replaceSize = 1;
        return str_replace(
            $simpleTextExpressionBracketed, $expressionLabel, $code,$replaceSize
        );
    }

    /**
     * @param string $code псевдо код с обрамляющими скобками
     * @return string псевдо код без обрамляющих скобок
     */
    public function removeBracket($code)
    {
        $firstLetter = substr($code, 0, 1);
        $lastLetter = substr($code, -1, 1);
        return $firstLetter === '(' && $lastLetter === ')'
            ? substr($code, 1, -1)
            : $code;
    }

    /**
     * @return SimpleTextExpression выражение в текстовом представлении без скобок
     */
    protected function createSimpleTextExpression()
    {
        return new SimpleTextExpression();
    }

    /**
     * @param string $code псевдо код
     * @return string[] список подвыражений (без скобок) в текстовом предсавлении
     */
    protected function getSimpleTextExpressionList($code)
    {
        preg_match_all(self::SUB_EXPRESSION_REGEXP, $code, $match);
        return $match[1];
    }

    /**
     * @param string $expressionText псевдо код
     * @return string[] список подвыражений (без скобок) в текстовом предсавлении (обрамленных скобками)
     */
    protected function getSimpleTextExpressionBracketedList($expressionText)
    {
        preg_match_all(self::SUB_EXPRESSION_REGEXP, $expressionText, $match);
        return $match[0];
    }
}