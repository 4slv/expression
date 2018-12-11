<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;


/** Операция деления */
class DivisionOperation extends Operation
{
    const MONEY_OPERATION = 'div';

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            $this->getLeftOperandTypeName()->isMoney()
            &&
            $this->getRightOperandTypeName()->isDigit()
        ){
            return $this->getTypeNameFactory()->createMoney();
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
            $this->getLeftOperandTypeName()->isMoney()
            &&
            $this->getRightOperandTypeName()->isDigit()
        ){
            return $this->getOperationToPhpTemplate()->objectMethod($this, self::MONEY_OPERATION);
        }

        if(
            $this->getLeftOperandTypeName()->isDigit()
            &&
            $this->getRightOperandTypeName()->isDigit()
        ){
            return $this->getOperationToPhpTemplate()->sameCode($this);
        }
        return $this->codeToPhpFailed();
    }

    public function getSign(): string
    {
        return OperationSign::DIVISION;
    }
}