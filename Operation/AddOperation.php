<?php

namespace Slov\Expression\Operation;


/** Операция сложения */
class AddOperation extends DigitOperation
{
    const MONEY_OPERATION = 'add';

    const DATE_INTERVAL_OPERATION = 'add';

    public function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if($firstOperandType->isMoney() && $secondOperandType->isMoney()){
            return $this->getTypeNameFactory()->createMoney();
        }

        if($firstOperandType->isDateInterval() && $secondOperandType->isDateInterval()){
            return $this->getTypeNameFactory()->createDateInterval();
        }

        if(($firstOperandType->isDateTime() && $secondOperandType->isDateInterval())){
            return $this->getTypeNameFactory()->createDateTime();
        }

        return $this->resolveDigitReturnTypeName();
    }

    public function toPhp($code): string
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if(
            ($firstOperandType->isDigit() && $secondOperandType->isDigit())
        ){
            return $this->toPhpSameCode($code);
        }
        if($firstOperandType->isMoney() && $secondOperandType->isMoney()){
            return $this->toPhpMoney($code);
        }
        if(
            ($firstOperandType->isDateTime() && $secondOperandType->isDateInterval())
            ||
            ($firstOperandType->isDateInterval() && $secondOperandType->isDateInterval())
        ){
            return $this->toPhpDateInterval($code);
        }
    }

    public function getPhpTemplate(): string
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if($firstOperandType->isDigit() && $secondOperandType->isDigit()){
            return $this->getPhpTemplatePrimitive();
        }
        if(
            ($firstOperandType->isMoney() && $secondOperandType->isMoney())
            ||
            ($firstOperandType->isDateTime() && $secondOperandType->isDateInterval())
        ){
            return $this->getPhpTemplateObject();
        }
        if($firstOperandType->isDateInterval() && $secondOperandType->isDateInterval()){
            return $this->getPhpTemplateIntervalOperationInterval();
        }
    }

}