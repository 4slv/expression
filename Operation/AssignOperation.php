<?php

namespace Slov\Expression\Operation;

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
            $this->getFirstOperandType()->isNull()
            &&
            $this->getFirstOperandType()->isNull()
        ){
            return $this->getTypeNameFactory()->createBoolean();
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