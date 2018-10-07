<?php

namespace Slov\Expression\Operation;

/** Операция сравнения */
abstract class CompareOperation extends Operation
{
    public function resolveReturnTypeName()
    {
        return $this->getTypeNameFactory()->createBoolean();
    }

    public function getPhpTemplate(): string
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if(
            ($firstOperandType->isDigit() && $secondOperandType->isDigit())
            ||
            ($firstOperandType->isDateTime() && $secondOperandType->isDateTime())
        )
        {
            return $this->getPhpTemplatePrimitive();
        }

        if($firstOperandType->isMoney() && $secondOperandType->isMoney())
        {
            return $this->getPhpTemplateObject();
        }
        if($firstOperandType->isDateInterval() && $secondOperandType->isDateInterval()){
            return $this->getPhpTemplateIntervalOperationInterval();
        }
        return null;
    }

    public function toPhp($code)
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if(
            ($firstOperandType->isDigit() && $secondOperandType->isDigit())
            ||
            ($firstOperandType->isDateTime() && $secondOperandType->isDateTime())
        ){
            return $this->toPhpSameCode($code);
        }
        if($firstOperandType->isMoney() && $secondOperandType->isMoney())
        {
            return $this->toPhpMoney($code);
        }
        if($firstOperandType->isDateInterval() && $secondOperandType->isDateInterval()){
            return $this->toPhpDateInterval($code);
        }
        return null;
    }
}