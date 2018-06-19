<?php

namespace Slov\Expression\Operation;

use MyCLabs\Enum\Enum;

class OperationName extends Enum
{
    const ADD = 'add';

    const MULTIPLY = 'multiply';

    const SUBTRACTION = 'subtraction';

    const DIVISION = 'division';

    const EXPONENTIATION = 'exponentiation';

    const REMAINDER_OF_DIVISION = 'remainderOfDivision';

    const DATE = 'date';

    const DAYS_IN_YEAR = 'daysInYear';

    const DAYS = 'days';

    const FUNCTION = 'function';

    /**
     * @return int приоритет операции (чем больше значение, тем выше приоритет)
     */
    public function getPriority()
    {
        switch ($this->getValue())
        {
            case self::ADD:
            case self::SUBTRACTION:
                return 1;
            case self::MULTIPLY:
            case self::DIVISION:
            case self::REMAINDER_OF_DIVISION:
                return 2;
            case self::EXPONENTIATION:
                return 3;
            case self::DATE:
            case self::DAYS_IN_YEAR:
            case self::DAYS:
            case self::FUNCTION:
                return 10;
        }
        return 0;
    }
}