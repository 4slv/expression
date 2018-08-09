<?php


namespace Slov\Expression\OperationCache\Traits;


trait PhpValues
{

    /**
     * @return string
     */
    public function generatePhpCode()
    {
        return $this->generatePhpValues($this->getFirstOperandCode(),$this->getSecondOperandCode(),$this->getFirstOperandType(),$this->getSecondOperandType());
    }

}