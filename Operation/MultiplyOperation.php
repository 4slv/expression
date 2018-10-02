<?php

namespace Slov\Expression\Operation;

/** Операция умножения */
class MultiplyOperation extends DigitOperation
{
    use MoneyOperationTrait;

    const MONEY_OPERATION = 'mul';

    protected function resolveReturnTypeName()
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
    }

    public function getPhpTemplate(): string
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();

        if($firstOperandType->isDigit() && $secondOperandType->isDigit()){
            return $this->getPhpTemplateDigit();
        }
        if($firstOperandType->isMoney() && $secondOperandType->isDigit()){
            return $this->getPhpTemplateMoney();
        }
        if($firstOperandType->isDigit() && $secondOperandType->isMoney()){
            return $this->getPhpTemplateMoneyInverse();
        }
    }
}