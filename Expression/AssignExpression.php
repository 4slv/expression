<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;

/** Выражение присваивания */
class AssignExpression extends Expression
{
    use VariableNameAccessor;

    const ASSIGN_SIGN = '=';

    const EXPRESSION_CODE_REGEXP = '/(\$\w[\w\d]*)\s*\=\s*(.+)/';

    protected function defineExpressionPart(CodeContext $codeContext): ExpressionPart
    {
        $assignExpressionCode = $this->getCode();
        if(preg_match(self::EXPRESSION_CODE_REGEXP, $assignExpressionCode, $match)){
            $variableName = $match[1];
            $expressionCode = $match[2];
            $this->setVariableName($variableName);
            $expressionPart = $this
                ->createExpressionWithBrackets()
                ->setCode($expressionCode)
                ->parse($codeContext);
            $this
                ->createVariable()
                ->setCode($expressionCode)
                ->setExpressionPart($expressionPart)
                ->setVariableName($variableName)
                ->parse($codeContext);
            return $expressionPart;
        }
        throw new CodeParseException($assignExpressionCode. ' :: code is not assign expression');
    }

    public function toPhp(CodeContext $codeContext): string
    {
        return implode(
            ' ',
            [
                $this->getVariableName(),
                self::ASSIGN_SIGN,
                parent::toPhp($codeContext)
            ]
        );
    }
}