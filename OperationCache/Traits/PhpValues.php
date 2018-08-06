<?php


namespace Slov\Expression\OperationCache\Traits;


trait PhpValues
{

    public function generatePhpCode()
    {
        $this->fillOperandsZeroIfNull();
        $resultTypeName = $this->resolveReturnTypeName();
        if(is_null($resultTypeName)){
            $this->throwOperationException();
        }
        return $this->generatePhpValues($this->getFirstOperandValue(),$this->getSecondOperandValue());
    }

}