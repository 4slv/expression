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

    const MONEY = 'money';

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

    const MIN = 'min';

    const MAX = 'max';

    /**
     * @return int приоритет операции (чем больше значение, тем выше приоритет)
     */
    public function getPriority()
    {
        switch ($this->getValue())
        {
            case self::ASSIGN:
                return 4;
            case self::OR:
                return 7;
            case self::AND:
                return 8;
            case self::EQUAL:
                return 12;
            case self::GREATER:
            case self::GREATER_OR_EQUALS:
            case self::LESS:
            case self::LESS_OR_EQUALS:
                return 13;
            case self::ADD:
            case self::SUBTRACTION:
                return 15;
            case self::MULTIPLY:
            case self::DIVISION:
            case self::REMAINDER_OF_DIVISION:
                return 16;
            case self::NOT:
                return 17;
            case self::EXPONENTIATION:
                return 20;
            case self::DATE:
            case self::DAYS_IN_YEAR:
            case self::DAYS:
            case self::INT:
            case self::MONEY:
                return 23;
            case self::FUNCTION:
            case self::IF_ELSE:
            case self::FOR:
            case self::MIN:
            case self::MAX:
                return 24;
        }
        return 0;
    }

    /**
     * @return bool true - левый операнд используется
     */
    public function leftOperandUsed(){
        switch ($this->getValue())
        {
            case self::ASSIGN:
            case self::NOT:
            case self::DATE:
            case self::DAYS_IN_YEAR:
            case self::DAYS:
            case self::FUNCTION:
            case self::IF_ELSE:
            case self::FOR:
            case self::INT:
            case self::MONEY:
            case self::MIN:
            case self::MAX:
                return false;
            default:
                return true;
        }
    }

    /**
     * @return bool true - правый операнд используется
     */
    public function rightOperandUsed(){
        switch ($this->getValue())
        {
            case self::FUNCTION:
            case self::IF_ELSE:
            case self::FOR:
            case self::MIN:
            case self::MAX:
                return false;
            default:
                return true;
        }
    }
}