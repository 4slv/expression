<?php

namespace Slov\Expression\Operation;


use MabeEnum\Enum;

/** Название операции */
class OperationName extends Enum
{
    const ADD = 'add';
    const MULTIPLY = 'multiply';
    const SUBTRACTION = 'subtraction';
    const DIVISION = 'division';
    const REMAINDER_OF_DIVISION = 'remainderOfDivision';
    const EXPONENTIATION = 'exponentiation';
    const EQUAL = 'equal';
    const GREATER = 'greater';
    const LESS = 'less';
    const GREATER_OR_EQUAL = 'greaterOrEqual';
    const LESS_OR_EQUAL = 'lessOrEqual';
    const NOT_EQUAL = 'notEqual';
    const NOT = 'not';
    const AND = 'and';
    const OR = 'or';
    const IF_ELSE = 'ifElse';

    /**
     * @return int приоритет операции (чем больше значение, тем выше приоритет)
     */
    public function getPriority()
    {
        switch ($this->getValue())
        {
            case self::IF_ELSE:
                return 4;
            case self::OR:
                return 7;
            case self::AND:
                return 8;
            case self::EQUAL:
            case self::NOT_EQUAL:
                return 12;
            case self::GREATER:
            case self::LESS:
            case self::GREATER_OR_EQUAL:
            case self::LESS_OR_EQUAL:
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
        }
        return 0;
    }
}