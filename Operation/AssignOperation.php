<?php

namespace Slov\Expression\Operation;
use Slov\Expression\Type\VariableType;

/** Операция присваивания */
class AssignOperation extends Operation
{

    use SingleOperandOperation;

    public function getOperationName()
    {
        return new OperationName(OperationName::ASSIGN);
    }

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isVariable()
        ){
            /** @var VariableType $firstOperand */
            $firstOperand = $this->getFirstOperand();
            $variable = $firstOperand->getVariableList()->get($firstOperand->getValue());

            var_dump("\n======", [$firstOperand->getValue()]);


            $firstOperand->getVariableList()->append($firstOperand->getValue(), $variable->calculate());

            return $this->getTypeFactory()->createBoolean();
        }
        return null;
    }

    /**
     * @param null $firstOperandValue значение первого операнда
     * @param null $secondOperandValue значение второго операнда
     * @return true
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        return true;
    }
}