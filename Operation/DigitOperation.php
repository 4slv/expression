<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Операция с числами */
abstract class DigitOperation extends Operation
{
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
            $this->getLeftOperandTypeName()->isDigit()
            &&
            $this->getRightOperandTypeName()->isDigit()
        ){
            return $this->getTypeNameFactory()->createFloat();
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
}