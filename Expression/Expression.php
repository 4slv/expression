<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\TypeName;

/** Выражение */
abstract class Expression extends ExpressionPart
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
    protected function setOperation(Operation $operation)
    {
        $this->operation = $operation;
        return $this;
    }

    /** Определить операцию выражения
     * @param CodeContext $codeContext контекст кода
     * @return Operation операция
     * @throws CodeParseException */
    abstract protected function defineOperation(CodeContext $codeContext): Operation;

    public function parse(CodeContext $codeContext)
    {
        $this->setOperation($this->defineOperation($codeContext));
        return parent::parse($codeContext);
    }

    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getExpressionList();
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