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

    const FIRST_YEAR_DAY = 'firstYearDay';

    const FUNCTION = 'function';

    const INT = 'int';

    const IF_ELSE = 'ifElse';

    const EQUAL = 'equal';

    const GREATER = 'greater';

    const LESS = 'less';

    const GREATER_OR_EQUALS = 'greaterOrEqual';

    const LESS_OR_EQUALS = 'lessOrEqual';

    const NOT = 'not';

    const AND = 'and';

    const OR = 'or';

    const ASSIGN = 'assign';

    const FOR = 'for';

    /**
     * @return int приоритет операции (чем больше значение, тем выше приоритет)
     */
    public function getPriority()
    {
        switch ($this->getValue())
        {
            case self::ASSIGN:
                return 1;
            case self::ADD:
            case self::SUBTRACTION:
                return 2;
            case self::MULTIPLY:
            case self::DIVISION:
            case self::REMAINDER_OF_DIVISION:
                return 3;
            case self::EXPONENTIATION:
                return 4;
            case self::NOT:
            case self::AND:
            case self::OR:
                return 5;
            case self::EQUAL:
            case self::GREATER:
            case self::GREATER_OR_EQUALS:
            case self::LESS:
            case self::LESS_OR_EQUALS:
                return 6;
            case self::DATE:
            case self::DAYS_IN_YEAR:
            case self::DAYS:
            case self::FUNCTION:
            case self::IF_ELSE:
            case self::FOR:
                return 10;
        }
        return 0;
    }
}