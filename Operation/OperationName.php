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

    /**
     * @return int приоритет операции (чем больше значение, тем выше приоритет)
     */
    public function getPriority()
    {
        switch ($this->getValue())
        {
            case self::ADD:
            case self::SUBTRACTION:
                return 15;
            case self::MULTIPLY:
            case self::DIVISION:
                return 16;
        }
        return 0;
    }

    /**
     * @return bool true - левый операнд используется
     */
    public function leftOperandUsed(){
        switch ($this->getValue())
        {
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
            default:
                return true;
        }
    }
}