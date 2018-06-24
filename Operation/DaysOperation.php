<?php

namespace Slov\Expression\Operation;

use DateInterval;
use Slov\Expression\Type\DateIntervalType;

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
        ) {
            return $this->getTypeNameFactory()->createInt();
        } elseif (
            $this->getFirstOperandType()->isNull()
            &&
            $this->getSecondOperandType()->isInt()
        ) {
            return $this->getTypeNameFactory()->createDateInterval();
        }
        return null;
    }

    /**
     * @param null $firstOperandValue значение первого операнда
     * @param DateInterval|int $secondOperandValue значение второго операнда
     * @return int|DateIntervalType
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        if($secondOperandValue instanceof DateInterval)
            /** Операция определения количества дней в интервале */
            return $secondOperandValue->d;
        else
            /** Преобразование целого числа во временной интервал */
            return DateInterval::createFromDateString($secondOperandValue . " day");

        return null;
    }
}