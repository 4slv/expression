<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\TypeName;

/** Выражение */
abstract class Expression extends ExpressionPart
{
    /** @var ExpressionPart часть выражения */
    protected $expressionPart;

    /**
     * @return ExpressionPart часть выражения
     */
    public function getExpressionPart(): ExpressionPart
    {
        return $this->expressionPart;
    }

    /**
     * @param ExpressionPart $expressionPart часть выражения
     * @return $this
     */
    protected function setExpressionPart(ExpressionPart $expressionPart)
    {
        $this->expressionPart = $expressionPart;
        return $this;
    }

    /** Определить операцию выражения
     * @param CodeContext $codeContext контекст кода
     * @return Operation операция
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