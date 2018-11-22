<?php

namespace Slov\Expression\Operation;

use DateTime;

class DateOperation extends Operation
{
    use SingleOperandOperation;

    public function getOperationName()
    {
        return OperationName::byValue(OperationName::DATE);
    }

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isNull()
            &&
            $this->getSecondOperandType()->isDateTime()
        ){
            return $this->getTypeNameFactory()->createDateTime();
        }
        return null;
    }

    /**
     * @param null $firstOperandValue значение первого операнда
     * @param DateTime $secondOperandValue значение второго операнда
     * @return DateTime
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        $returnDate = clone $secondOperandValue;
        $returnDate->setTime(0,0,0,0);
        return $returnDate;
    }
}