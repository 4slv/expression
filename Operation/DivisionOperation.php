<?php

namespace Slov\Expression\Operation;


/** Операция деления */
class DivisionOperation extends DigitOperation
{
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

    public function toPhp($code, $codeContext): string
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if($firstOperandType->isDigit() && $secondOperandType->isDigit()){
            return $this->toPhpSameCode($code);
        }
        if(
            $firstOperandType->isMoney() && $secondOperandType->isDigit()
        ){
            return $this->toPhpMoney($code);
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
        if($firstOperandType->isMoney() && $secondOperandType->isDigit()){
            return $this->getPhpTemplateObject();
        }
        return null;
    }
}