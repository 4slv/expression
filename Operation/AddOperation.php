<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

class AddOperation extends DigitOperation
{
    const MONEY_OPERATION = 'add';

    const DATE_INTERVAL_OPERATION = 'add';

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            $this->getLeftOperandTypeName()->isMoney()
            &&
            $this->getRightOperandTypeName()->isMoney()
        ){
            return $this->getTypeNameFactory()->createMoney();
        }

        if(
            (
                $this->getLeftOperandTypeName()->isDateTime()
                &&
                $this->getRightOperandTypeName()->isDateInterval()
            )
            ||
            (
                $this->getLeftOperandTypeName()->isDateInterval()
                &&
                $this->getRightOperandTypeName()->isDateTime()
            )
        ){
            return $this->getTypeNameFactory()->createDateTime();
        }

        return parent::typeDefinition($codeContext);
    }

    public function toPhp(CodeContext $codeContext): string
    {
        if(
            $this->getLeftOperandTypeName()->isMoney()
            &&
            $this->getRightOperandTypeName()->isMoney()
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->objectMethod($this, self::MONEY_OPERATION);
        }

        if(
            $this->getLeftOperandTypeName()->isDateTime()
            &&
            $this->getRightOperandTypeName()->isDateInterval()
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->objectMethod($this, self::DATE_INTERVAL_OPERATION);
        }

        if(
            $this->getLeftOperandTypeName()->isDateInterval()
            &&
            $this->getRightOperandTypeName()->isDateTime()
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->objectMethodReverse($this, self::DATE_INTERVAL_OPERATION);
        }

        return parent::toPhp($codeContext);
    }

    public function getSign(): string
    {
        return OperationSign::ADD;
    }
}