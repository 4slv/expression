<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Остаток от деления */
class RemainderOfDivisionOperation extends Operation
{
    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            $this->getLeftOperandTypeName()->isDigit()
            &&
            $this->getRightOperandTypeName()->isDigit()
        ){
            return $this->getTypeNameFactory()->createInt();
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
        return OperationSign::REMINDER_OF_DIVISION;
    }
}