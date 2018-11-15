<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

class AddOperation extends Operation
{
    const OPERATION_SIGN = '+';

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            $this->getLeftOperandTypeName()->isInt()
            &&
            $this->getRightOperandTypeName()->isInt()
        ){
            return $this->getLeftOperandTypeName();
        }

        if(
            $this->getLeftOperandTypeName()->isFloat()
            ||
            $this->getRightOperandTypeName()->isFloat()
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