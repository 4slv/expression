<?php

namespace Slov\Expression\Expression;

/** Доступ к названию переменной */
trait VariableNameAccessor
{
    /** @var string название переменной */
    protected $variableName;

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


}