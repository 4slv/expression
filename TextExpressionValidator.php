<?php

namespace Slov\Expression;

use Slov\Expression\Type\TypeName;
use Slov\Expression\TextExpression\TextExpression;

/** Валидатор выражения в текстовом представлении */
class TextExpressionValidator extends TextExpression
{
    /**
     * @throws ExpressionException
     */
    public function validate()
    {
        $this->validateSubExpressionList($this->getExpressionTextWithoutComments());
    }

    /**
     * Валидация списка выражений
     * @param string $expressionText выражение в текстовом представлении
     * @throws ExpressionException
     */
    public function validateSubExpressionList($expressionText)
    {
        $subExpressionTextList = $this->getSimpleTextExpressionList($expressionText);
        foreach($subExpressionTextList as $subExpressionText)
        {
            $this->validateExpressionWithoutBracket($subExpressionText);
        }
        $expressionTextWithoutSubExpressions = $this->replaceSubExpressionToExpressionText($expressionText);
        if(count($subExpressionTextList) > 0){
            $this->validateSubExpressionList($expressionTextWithoutSubExpressions);
        } else {
            $this->validateExpressionWithoutBracket($expressionTextWithoutSubExpressions);
        }
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return string выражение (текстовое) в котором заменены все подвыражения без скобок словом "expression"
     */
    public function replaceSubExpressionToExpressionText($expressionText)
    {
        $subExpressionTextBracketedList = $this->getSimpleTextExpressionBracketedList($expressionText);
        return str_replace($subExpressionTextBracketedList, TypeName::EXPRESSION, $expressionText);
    }

    /**
     * Валидация выражения без скобок
     * @param string $expressionText выражение в текстовом представлении (без скобок)
     * @throws ExpressionException
     */
    protected function validateExpressionWithoutBracket($expressionText)
    {
        foreach($this->getTrimOperandList($expressionText) as $operand)
        {
            $this->getOperandType($operand);
        }
    }
}