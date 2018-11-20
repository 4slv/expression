<?php

namespace Slov\Expression\Statement;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodePart;
use Slov\Expression\Expression\ExpressionPartAccessor;

class SimpleStatement extends CodePart
{
    use ExpressionPartAccessor;

    /** Определить операцию выражения
     * @param CodeContext $codeContext контекст кода
     * @return Operation операция
     * @throws CodeParseException */
    protected function defineExpressionPart(CodeContext $codeContext): ExpressionPart
    {

    }

    public function parse(CodeContext $codeContext)
    {
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
        return $this->getExpressionPart()->toPhp($codeContext). ';';
    }
}