<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Expression;

/** Цифровая операция */
abstract class DigitOperation extends Operation
{
    protected function resolveDigitReturnTypeName()
    {
        if(
            $this->getFirstOperandTypeName()->isInt()
            &&
            $this->getSecondOperandTypeName()->isInt()
        ){
            return $this->getTypeNameFactory()->createInt();
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

    public function toPhpDigit($code): string
    {
        return $code;
    }

    public function getPhpTemplateDigit(): string
    {
        return implode(
            ' ',
            [
                Expression::FIRST_OPERAND,
                Expression::OPERATION,
                Expression::SECOND_OPERAND
            ]
        );
    }
}