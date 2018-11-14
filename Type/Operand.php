<?php

namespace Slov\Expression\Type;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Expression\ExpressionPart;
use Slov\Expression\Code\CodeParseException;

/** Операнд */
class Operand extends ExpressionPart
{
    /** разбор кода операнда
     * @param CodeContext $codeContext контекст кода
     * @return $this
     * @throws CodeParseException */
    public function parse(CodeContext $codeContext)
    {
        $typeName = $this->typeDefinition($codeContext);
        $this->setTypeName($typeName);
        $contextList = $this->getContextList($codeContext);
        $label = $contextList->append($this);
        $this->setLabel($label);
        $php = $this->toPhp($codeContext);
        $this->setPhp($php);
        return $this;
    }

    public function toPhp(CodeContext $codeContext): string
    {
        switch($this->getTypeName()->getValue())
        {
            case TypeName::INT:
            case TypeName::FLOAT:
                return $this->getCode();
        }
        return $this->toPhpParseError();
    }

    /** @param CodeContext $codeContext контекст кода
     * @return OperandList */
    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getOperandList();
    }

    /**
     * @param CodeContext $codeContext
     * @return TypeName
     * @throws CodeParseException
     */
    protected function typeDefinition(CodeContext $codeContext): TypeName
    {
        return TypeRegExp::getTypeNameByStringValue($this->getCode());
    }
}