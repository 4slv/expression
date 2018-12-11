<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Операция вычитания */
class SubtractionOperation extends DigitOperation
{
    const MONEY_OPERATION = 'sub';

    const DATE_INTERVAL_OPERATION = 'sub';

    const DATETIME_OPERATION = 'diff';

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            $this->getLeftOperandTypeName()->isMoney()
            ||
            $this->getRightOperandTypeName()->isMoney()
        ){
            return $this->getTypeNameFactory()->createMoney();
        }

        if(
            (
                $this->getLeftOperandTypeName()->isDateInterval()
                &&
                $this->getRightOperandTypeName()->isDateInterval()
            )
            ||
            (
                $this->getLeftOperandTypeName()->isDateTime()
                &&
                $this->getRightOperandTypeName()->isDateTime()
            )
        ){
            return $this->getTypeNameFactory()->createDateInterval();
        }

        if(
            $this->getLeftOperandTypeName()->isDateTime()
            &&
            $this->getRightOperandTypeName()->isDateInterval()
        ){
            return $this->getTypeNameFactory()->createDateTime();
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

        if(
            $this->getLeftOperandTypeName()->isDateInterval()
            &&
            $this->getRightOperandTypeName()->isDateInterval()
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->intervalMethod($this, self::DATE_INTERVAL_OPERATION);
        }

        if(
            $this->getLeftOperandTypeName()->isDateTime()
            &&
            $this->getRightOperandTypeName()->isDateTime()
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->cloneObjectMethodReverse($this, self::DATETIME_OPERATION);
        }

        if(
            $this->getLeftOperandTypeName()->isDateTime()
            &&
            $this->getRightOperandTypeName()->isDateInterval()
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->cloneObjectMethod($this, self::DATE_INTERVAL_OPERATION);
        }

        return parent::toPhp($codeContext);
    }

    public function getSign(): string
    {
        return OperationSign::SUBTRACTION;
    }
}