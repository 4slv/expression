<?php

namespace Slov\Expression\Operation;

use DateInterval;

/** Операция определения количества дней в интервале */
class DaysOperation extends Operation
{
    use SingleOperandOperation;

    public function getOperationName()
    {
        return new OperationName(OperationName::DAYS);
    }

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isNull()
            &&
            $this->getSecondOperandType()->isDateInterval()
        ){
            return $this->getTypeNameFactory()->createInt();
        }
        return null;
    }

    /**
     * @param null $firstOperandValue значение первого операнда
     * @param DateInterval $secondOperandValue значение второго операнда
     * @return int
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        return $secondOperandValue->d;
    }
}