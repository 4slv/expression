<?php

namespace Slov\Expression\Operation;


/** Операция вычитания */
class SubtractionOperation extends DigitOperation
{
    const MONEY_OPERATION = 'sub';

    const DATE_INTERVAL_OPERATION = 'sub';

    const DATETIME_OPERATION = 'diff';

    public function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if($firstOperandType->isMoney() && $secondOperandType->isMoney()){
            return $this->getTypeNameFactory()->createMoney();
        }

        if(
            ($firstOperandType->isDateInterval() && $secondOperandType->isDateInterval())
            ||
            ($firstOperandType->isDateTime() && $secondOperandType->isDateTime())
        ){
            return $this->getTypeNameFactory()->createDateInterval();
        }

        if($firstOperandType->isDateTime() && $secondOperandType->isDateInterval()){
            return $this->getTypeNameFactory()->createDateTime();
        }

        return $this->resolveDigitReturnTypeName();
    }


    public function toPhp($code, $codeContext): string
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if($firstOperandType->isDigit() && $secondOperandType->isDigit()){
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
            return $this->toPhpDateInterval();
        }
        if($firstOperandType->isDateTime() && $secondOperandType->isDateTime()){
            return $this->toPhpDatetime($code);
        }
        return null;
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
        if($firstOperandType->isDateTime() && $secondOperandType->isDateTime())
        {
            return $this->getPhpTemplateObjectInverse();
        }
        if($firstOperandType->isDateInterval() && $secondOperandType->isDateInterval()){
            return $this->getPhpTemplateIntervalOperationInterval();
        }
        return null;
    }
}