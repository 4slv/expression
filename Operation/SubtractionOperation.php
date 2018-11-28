<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Операция вычитания */
class SubtractionOperation extends DigitOperation
{
    const MONEY_OPERATION = 'sub';

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            $this->getLeftOperandTypeName()->isMoney()
            ||
            $this->getRightOperandTypeName()->isMoney()
        ){
            return $this->getTypeNameFactory()->createFloat();
        }

        return parent::typeDefinition($codeContext);
    }

    public function toPhp(CodeContext $codeContext): string
    {
        if(
            $this->getLeftOperandTypeName()->isMoney()
            ||
            $this->getRightOperandTypeName()->isMoney()
        ){
            return $this->getOperationToPhpTemplate()->objectMethod($this, self::MONEY_OPERATION);
        }

        return parent::toPhp($codeContext);
    }

    public function getSign(): string
    {
        return OperationSign::SUBTRACTION;
    }
}