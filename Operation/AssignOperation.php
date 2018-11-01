<?php

namespace Slov\Expression\Operation;


/** Операция присваивания */
class AssignOperation extends Operation
{

    /** @var string название переменной */
    private $variableName;

    /**
     * @return string название переменной
     */
    public function getVariableName(): string
    {
        return $this->variableName;
    }

    /**
     * @param string $variableName название переменной
     * @return $this
     */
    public function setVariableName(string $variableName)
    {
        $this->variableName = $variableName;
        return $this;
    }

    public function resolveReturnTypeName()
    {
        return $this->getSecondOperandTypeName();
    }

    public function getPhpTemplate(): string
    {
        return $this->getPhpTemplatePrimitive();
    }

    public function toPhp($code, $codeContext): string
    {
        return $code;
    }
}