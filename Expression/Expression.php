<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\TypeName;

class Expression extends ExpressionPart
{
    /** @var Operation операция */
    protected $operation;

    /**
     * @return Operation операция
     */
    public function getOperation(): Operation
    {
        return $this->operation;
    }

    /**
     * @param Operation $operation операция
     * @return $this
     */
    public function setOperation(Operation $operation)
    {
        $this->operation = $operation;
        return $this;
    }

    protected function getContextList(CodeContext $codeContext)
    {
        $codeContext->getExpressionList();
    }

    protected function typeDefinition(CodeContext $codeContext): TypeName
    {
        return $this->getOperation()->typeDefinition($codeContext);
    }

    public function toPhp(CodeContext $codeContext): string
    {
        return $this->getOperation()->toPhp($codeContext);
    }
}