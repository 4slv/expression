<?php

namespace Slov\Expression\Operation;



use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Операция сравнения */
abstract class CompareOperation extends Operation
{
    const MONEY_OPERATION = 'compare';

    const DATE_INTERVAL_OPERATION = 'compare';

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            (
                $this->getLeftOperandTypeName()->isDigit()
                &&
                $this->getRightOperandTypeName()->isDigit()
            )
            ||
            (
                $this->getLeftOperandTypeName()->isDateTime()
                &&
                $this->getRightOperandTypeName()->isDateTime()
            )
            ||
            (
                $this->getLeftOperandTypeName()->isMoney()
                &&
                $this->getRightOperandTypeName()->isMoney()
            )
            ||
            (
                $this->getLeftOperandTypeName()->isDateInterval()
                &&
                $this->getRightOperandTypeName()->isDateInterval()
            )
            ||
            (
                $this->getLeftOperandTypeName()->isString()
                &&
                $this->getRightOperandTypeName()->isString()
            )
        ){
            return $this->getTypeNameFactory()->createBoolean();
        }
        return $this->typeDefinitionFailed();
    }

    public function toPhp(CodeContext $codeContext): string
    {
        if(
            (
                $this->getLeftOperandTypeName()->isDigit()
                &&
                $this->getRightOperandTypeName()->isDigit()
            )
            ||
            (
                $this->getLeftOperandTypeName()->isDateTime()
                &&
                $this->getRightOperandTypeName()->isDateTime()
            )
            ||
            (
                $this->getLeftOperandTypeName()->isString()
                &&
                $this->getRightOperandTypeName()->isString()
            )
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->sameCode($this);
        }

        if(
            $this->getLeftOperandTypeName()->isMoney()
            &&
            $this->getRightOperandTypeName()->isMoney()
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->objectMethod($this, static::MONEY_OPERATION);
        }

        if(
            $this->getLeftOperandTypeName()->isDateInterval()
            &&
            $this->getRightOperandTypeName()->isDateInterval()
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->intervalMethod($this, static::DATE_INTERVAL_OPERATION);
        }

        return parent::toPhp($codeContext);
    }
}
