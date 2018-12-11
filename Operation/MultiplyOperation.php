<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Операция умножения */
class MultiplyOperation extends DigitOperation
{
    const MONEY_OPERATION = 'mul';

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            (   $this->getLeftOperandTypeName()->isMoney()
                &&
                $this->getRightOperandTypeName()->isDigit()
            )
            ||
            (
                $this->getLeftOperandTypeName()->isDigit()
                &&
                $this->getRightOperandTypeName()->isMoney()
            )
        ){
            return $this->getTypeNameFactory()->createMoney();
        }

        return parent::typeDefinition($codeContext);
    }

    public function toPhp(CodeContext $codeContext): string
    {
        if(
            $this->getLeftOperandTypeName()->isMoney() && $this->getRightOperandTypeName()->isDigit()
        ){
            return $this->getOperationToPhpTemplate()->objectMethod($this, self::MONEY_OPERATION);
        }
        if($this->getLeftOperandTypeName()->isDigit() && $this->getRightOperandTypeName()->isMoney())
        {
            return $this->getOperationToPhpTemplate()->objectMethodReverse($this, self::MONEY_OPERATION);
        }
        return parent::toPhp($codeContext);
    }

    public function getSign(): string
    {
        return OperationSign::MULTIPLY;
    }
}