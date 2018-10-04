<?php

namespace Slov\Expression\Operation;


/** Остаток от деления */
class RemainderOfDivisionOperation extends DigitOperation
{
    public function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandTypeName()->isDigit()
            &&
            $this->getSecondOperandTypeName()->isDigit()
        ){
            return $this->getTypeNameFactory()->createInt();
        }
        return null;
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
            return $this->toPhpSameCode($code);
        }
        return null;
    }

    public function getPhpTemplate(): string
    {
        return parent::getPhpTemplatePrimitive();
    }
}