<?php

namespace Slov\Expression\Operation;


/** Операция деления */
class DivisionOperation extends DigitOperation
{
    use MoneyOperationTrait;

    const MONEY_OPERATION = 'div';

    public function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandTypeName()->isMoney()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $this->getTypeNameFactory()->createMoney();
        }

        if(
            $this->getFirstOperandTypeName()->isDigit()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $this->getTypeNameFactory()->createFloat();
        }
        return null;
    }

    /**
     * @param string $code псевдо-код операции
     * @return string php-код операции
     */
    public function toPhp($code)
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if($firstOperandType->isDigit() && $secondOperandType->isDigit()){
            return $code;
        }
        if(
            $firstOperandType->isMoney() && $secondOperandType->isDigit()
        ){
            return $this->toPhpMoney($code);
        }
    }

    public function getPhpTemplate(): string
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if($firstOperandType->isDigit() && $secondOperandType->isDigit()){
            return $this->getPhpTemplatePrimitive();
        }
        if($firstOperandType->isMoney() && $secondOperandType->isDigit()){
            return $this->getPhpTemplateObject();
        }
    }
}