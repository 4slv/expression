<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Переменная */
class Variable extends ExpressionPart
{
    use ExpressionPartAccessor;
    use VariableNameAccessor;

    protected function defineLabel(): ?string
    {
        return $this->getVariableName();
    }

    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getVariableList();
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