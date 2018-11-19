<?php

namespace Slov\Expression\Statement;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Expression\ExpressionPart;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\TypeName;

class SimpleStatement extends ExpressionPart
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

    protected function typeDefinition(CodeContext $codeContext): TypeName
    {
        return $this->getOperation()->typeDefinition($codeContext);
    }

    public function toPhp(CodeContext $codeContext): string
    {
        return $this->getOperation()->toPhp($codeContext);
    }
}