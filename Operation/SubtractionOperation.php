<?php

namespace Slov\Expression\Operation;


/** Операция вычитания */
class SubtractionOperation extends Operation
{
    use DigitOperationTrait;

    protected function resolveReturnTypeName()
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
     * @return string php-код операции
     */
    public function toPhp($code)
    {
        if(
            $this->getFirstOperandTypeName()->isDigit()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $code;
        }
    }
}