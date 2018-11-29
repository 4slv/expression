<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;


/** Вызов функции */
class FunctionCall extends ExpressionPart
{
    /** @var string название функции */
    protected $functionName;

    /** @var string[] список меток параметров */
    protected $parameterLabelList;

    /**
     * @return string название функции
     */
    public function getFunctionName(): string
    {
        return $this->functionName;
    }

    /**
     * @param string $functionName название функции
     * @return $this
     */
    protected function setFunctionName(string $functionName)
    {
        $this->functionName = $functionName;
        return $this;
    }

    protected function typeDefinition(CodeContext $codeContext): TypeName
    {
        return TypeName::has($this->getFunctionName())
            ? TypeName::byValue($this->getFunctionName())
            : TypeName::byValue(TypeName::UNKNOWN);
    }

    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getFunctionCallList();
    }

    public function toPhp(CodeContext $codeContext): string
    {
        // TODO: Implement toPhp() method.
    }
}