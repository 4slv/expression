<?php

namespace Slov\Expression\Operation;

use DateTime;

/** Операция определения количества дней в году указанной даты */
class DaysInYearOperation extends Operation
{
    use SingleOperandOperation;

    public function getOperationName()
    {
        return OperationName::byValue(OperationName::DAYS_IN_YEAR);
    }

    protected function resolveReturnTypeName()
    {
        if(
            $this->getFirstOperandType()->isNull()
            &&
            $this->getSecondOperandType()->isDateTime()
        ){
            return $this->getTypeNameFactory()->createInt();
        }
        return null;
    }

    /**
     * @param null $firstOperandValue значение первого операнда
     * @param DateTime $secondOperandValue значение второго операнда
     * @return int
     */
    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        $dateYear = (int)$secondOperandValue->format('Y');

        $dateBegin = $secondOperandValue
            ->setDate($dateYear, 0, 0)
            ->setTime(0,0,0);

        $dateEnd = clone $dateBegin;
        $dateEnd->modify('+1 year');

        return $dateEnd->diff($dateBegin)->days;
    }
}