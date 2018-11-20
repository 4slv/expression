<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Type\TypeName;

/** Выражение */
abstract class Expression extends ExpressionPart
{
    use ExpressionPartAccessor;

    /** Определить операцию выражения
     * @param CodeContext $codeContext контекст кода
     * @return ExpressionPart часть выражения
     * @throws CodeParseException */
    abstract protected function defineExpressionPart(CodeContext $codeContext): ExpressionPart;

    public function parse(CodeContext $codeContext)
    {
        $this->setExpressionPart($this->defineExpressionPart($codeContext));
        return parent::parse($codeContext);
    }

    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getExpressionList();
    }

    protected function typeDefinition(CodeContext $codeContext): TypeName
    {
        return $this->getExpressionPart()->typeDefinition($codeContext);
    }

    public function toPhp(CodeContext $codeContext): string
    {
        return $this->getExpressionPart()->toPhp($codeContext);
    }
}