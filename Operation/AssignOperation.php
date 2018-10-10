<?php

namespace Slov\Expression\Operation;

use Slov\Expression\TextExpression\VariableList;
use Slov\Expression\TextExpression\VariableStructure;


/** Операция присваивания */
class AssignOperation extends Operation
{

    /** @var string название переменной */
    private $variableName;

    /** @var VariableList список переменных */
    private $variableList;

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

    public function resolveReturnTypeName()
    {
        return $this->getTypeNameFactory()->createBoolean();
    }

    public function getPhpTemplate(): string
    {
        return $this->getPhpTemplateAssign();
    }

    public function toPhp($code)
    {
        return $this->toPhpSameCode($code);
    }
}