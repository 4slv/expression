<?php

namespace Slov\Expression\Operation;

use DateTime;
use DateInterval;
use Slov\Expression\Type\DateIntervalType;

class DaysOperation extends Operation
{
    use SingleOperandOperation;

    public function getOperationName()
    {
        return OperationName::byValue(OperationName::DAYS);
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
     * @return int|DateInterval
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        if($secondOperandValue instanceof DateInterval) {
            /** Операция определения количества дней в интервале */
            if($secondOperandValue->days === false){
                $seconds = (new DateTime())
                    ->setTimeStamp(0)
                    ->add($secondOperandValue)
                    ->getTimeStamp();
                $days = $seconds / 86400;
                return (int) $days;
            } else {
                return $secondOperandValue->days;
            }
        } else {
            /** Преобразование целого числа во временной интервал */
            return DateInterval::createFromDateString($secondOperandValue . " day");
        }
    }
}