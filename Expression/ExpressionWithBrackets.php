<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Operation\Operation;

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

    protected function defineOperation(CodeContext $codeContext): Operation
    {
        $expressionWithoutBracketsFinder = $this->getExpressionWithoutBracketsFinder();
        $expressionCode = $this->getCode();
        $operation = null;
        while (
            $expressionWithoutBracketsFinder
                ->checkExpressionExists($codeContext,$expressionCode)
        ){
            
        }
    }

}