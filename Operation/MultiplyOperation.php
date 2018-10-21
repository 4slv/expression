<?php

namespace Slov\Expression\Operation;

/** Операция умножения */
class MultiplyOperation extends DigitOperation
{
    const MONEY_OPERATION = 'mul';

    public function resolveReturnTypeName()
    {
        if(
            ($this->getFirstOperandTypeName()->isMoney() && $this->getSecondOperandTypeName()->isDigit())
            ||
            ($this->getFirstOperandTypeName()->isDigit() && $this->getSecondOperandTypeName()->isMoney())
        ){
            return $this->getTypeNameFactory()->createMoney();
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
        if(
            $firstOperandType->isMoney() && $secondOperandType->isDigit()
            ||
            $firstOperandType->isDigit() && $secondOperandType->isMoney()
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
        if($firstOperandType->isDigit() && $secondOperandType->isMoney()){
            return $this->getPhpTemplateObjectInverse();
        }
        return null;
    }
}