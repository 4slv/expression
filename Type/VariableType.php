<?php

namespace Slov\Expression\Type;

use Slov\Expression\TextExpression\VariableList;

/** Тип переменной */
class VariableType extends Type
{
    /** @var VariableList список переменных */
    private $variableList;

    /**
     * @return VariableList список переменных
     */
    public function getVariableList(): VariableList
    {
        return $this->variableList;
    }

    /**
     * @param VariableList $variableList список переменных
     * @return $this
     */
    public function setVariableList(VariableList $variableList)
    {
        $this->variableList = $variableList;
        return $this;
    }
}