<?php

namespace Slov\Expression\Type;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Expression\ExpressionPart;
use Slov\Expression\Code\CodeParseException;

/** Операнд */
class Operand extends ExpressionPart
{
    public function toPhp(CodeContext $codeContext): string
    {
        if($codeContext->checkLabelIsExpressionPart($this->getCodeTrim())){
            return $codeContext->getExpressionPartByLabel($this->getCodeTrim())->getPhp();
        }

        switch($this->getTypeName()->getValue())
        {
            case TypeName::INT:
            case TypeName::FLOAT:
                return $this->getCodeTrim();
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
     * @param CodeContext $codeContext контекст кода
     * @return TypeName
     * @throws CodeParseException
     */
    protected function typeDefinition(CodeContext $codeContext): TypeName
    {
        return $codeContext->checkLabelIsExpressionPart($this->getCodeTrim())
            ? $codeContext->getExpressionPartByLabel($this->getCodeTrim())->getTypeName()
            : TypeRegExp::getTypeNameByStringValue($this->getCodeTrim());

    }
}