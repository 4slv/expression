<?php

namespace Slov\Expression\Operation;


/** Операция вычитания */
class SubtractionOperation extends DigitOperation
{
    use MoneyOperationTrait,
        DateIntervalOperationTrait,
        DatetimeOperationTrait;

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

    /**
     * @param string $code псевдо-код операции
     * @return string|null php-код операции
     */
    public function toPhp($code): string
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if($firstOperandType->isDigit() && $secondOperandType->isDigit()){
            return $this->toPhpDigit($code);
        }
        if($firstOperandType->isMoney() && $secondOperandType->isMoney()){
            return $this->toPhpMoney($code);
        }
        if($firstOperandType->isDateTime() && $secondOperandType->isDateInterval()){
            return $this->toPhpDateInterval($code);
        }
        if($firstOperandType->isDateTime() && $secondOperandType->isDateTime()){
            return $this->toPhpDatetime($code);
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
        if($firstOperandType->isDateTime() && $firstOperandType->isDateTime())
        {
            return $this->getPhpTemplateObjectInverse();
        }
    }
}