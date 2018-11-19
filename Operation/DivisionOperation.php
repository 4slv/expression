<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;


/** Операция деления */
class DivisionOperation extends Operation
{
    const OPERATION_SIGN = '/';

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            $this->getLeftOperandTypeName()->isDigit()
            &&
            $this->getRightOperandTypeName()->isDigit()
        ){
            return TypeName::byName(TypeName::FLOAT);
        }
        return $this->typeDefinitionFailed();
    }

    public function toPhp(CodeContext $codeContext): string
    {
        if(
            $this->getLeftOperandTypeName()->isDigit()
            &&
            $this->getLeftOperandTypeName()->isDigit()
        ){
            return $this->getOperationToPhpTemplate()->sameCode($this);
        }
        return $this->codeToPhpFailed();
    }

    public function getSign(): string
    {
        return self::OPERATION_SIGN;
    }
}