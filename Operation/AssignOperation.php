<?php

namespace Slov\Expression\Operation;

use Slov\Expression\TextExpression\VariableList;


/** Операция присваивания */
class AssignOperation extends Operation
{

    use SingleOperandOperation;

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

    public function calculate()
    {
        $secondOperand = $this->secondOperand;

        $this->variableList->append(
            $this->getVariableName(),
            $secondOperand->calculate()
        );

        return $this->getTypeFactory()->createBoolean()->setValue(true);
    }

    public function getOperationName()
    {
        return new OperationName(OperationName::ASSIGN);
    }

    protected function resolveReturnTypeName()
    {
    }

    /**
     * @param null $firstOperandValue значение первого операнда
     * @param null $secondOperandValue значение второго операнда
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue): void
    {
    }
}