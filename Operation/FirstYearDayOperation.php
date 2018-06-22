<?php

namespace Slov\Expression\Operation;

use DateInterval;
use Slov\Expression\Type\DateIntervalType;

/** Операция преобразования указанной даты в дату первого числа года */
class FirstYearDayOperation extends Operation
{
    use SingleOperandOperation;

    public function getOperationName()
    {
        return new OperationName(OperationName::FIRST_YEAR_DAY);
    }

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isNull()
            &&
            $this->getSecondOperandType()->isDateTime()
        ) {
            return $this->getTypeNameFactory()->createDateTime();
        }

        return null;
    }

    /**
     * @param null $firstOperandValue значение первого операнда
     * @param \DateTime $secondOperandValue значение второго операнда
     * @return \DateTime
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        if($secondOperandValue instanceof \DateTime) {
            return (new \DateTime())
                ->setDate($secondOperandValue->format('Y'), 1, 1)
                ->setTime(0,0,0);
        }

        return null;
    }
}