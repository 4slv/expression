<?php

namespace Slov\Expression\Operation;


abstract class BooleanOperation extends Operation
{
    public function resolveReturnTypeName()
    {
        $firstOperandType = $this->getFirstOperandTypeName();
        $secondOperandType = $this->getSecondOperandTypeName();
        if($firstOperandType->isBoolean() && $secondOperandType->isBoolean()){
            return $this->getTypeNameFactory()->createBoolean();
        }
        return null;
    }

    public function getPhpTemplate(): string
    {
        return $this->getPhpTemplatePrimitive();
    }

    public function toPhp($code, $codeContext): string
    {
        return $this->toPhpSameCode($code);
    }
}