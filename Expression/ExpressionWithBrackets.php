<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Code\CodeContext;

/** Выражение со скобками */
class ExpressionWithBrackets extends Expression
{
    /** @var ExpressionWithoutBracketsFinder поиск выражения без скобок */
    protected $expressionWithoutBracketsFinder;

    /**
     * @return ExpressionWithoutBracketsFinder поиск выражения без скобок
     */
    public function getExpressionWithoutBracketsFinder(): ExpressionWithoutBracketsFinder
    {
        if(is_null($this->expressionWithoutBracketsFinder)){
            $this->expressionWithoutBracketsFinder = new ExpressionWithoutBracketsFinder();
        }
        return $this->expressionWithoutBracketsFinder;
    }

    protected function defineExpressionPart(CodeContext $codeContext): ExpressionPart
    {
        $expressionWithoutBracketsFinder = $this->getExpressionWithoutBracketsFinder();
        $expressionCode = $this->getCode();
        $expressionPart = null;
        while ($codeContext->checkLabelIsExpressionPart($expressionCode) === false){
            $expressionPart = $expressionWithoutBracketsFinder
                ->find($codeContext, $expressionCode);
            $replaceTimes = 1;

            $expressionCode = str_replace(
                $expressionPart->getOriginalCode(),
                $expressionPart->getLabel(),
                $expressionCode,
                $replaceTimes
            );
        }
        return $expressionPart;
    }

}