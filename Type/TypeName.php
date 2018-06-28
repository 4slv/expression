<?php

namespace Slov\Expression\Type;

use MyCLabs\Enum\Enum;

/** Название типа */
class TypeName extends Enum
{
    const DATE_TIME = 'date_time';
    const DATE_INTERVAL = 'date_interval';
    const INT = 'int';
    const FLOAT = 'float';
    const NULL = 'null';
    const MONEY = 'money';
    const STRING = 'string';
    const EXPRESSION = '_Expression';
    const VARIABLE = 'variable';
    const FUNCTION = 'function';
    const IF_ELSE = 'if_else';
    const BOOLEAN = 'boolean';
    const ASSIGN = 'assign';

    /**
     * @return bool тип является цифровым
     */
    public function isDigit()
    {
        switch ($this->getValue())
        {
            case self::INT:
            case self::FLOAT:
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool true - является целым числом
     */
    public function isInt()
    {
        return $this->getValue() === self::INT;
    }

    /**
     * @return boolean true - тип: отсутствие значения
     */
    public function isNull()
    {
        return $this->getValue() === self::NULL;
    }

    /**
     * @return boolean true - тип: Money
     */
    public function isMoney()
    {
        return $this->getValue() === self::MONEY;
    }

    /**
     * @return bool true - тип DateTime
     */
    public function isDateTime()
    {
        return $this->getValue() === self::DATE_TIME;
    }

    /**
     * @return bool true - тип DateInterval
     */
    public function isDateInterval()
    {
        return $this->getValue() === self::DATE_INTERVAL;
    }

    /**
     * @return bool true - тип string
     */
    public function isString()
    {
        return $this->getValue() === self::STRING;
    }

    /**
     * @return bool true - тип boolean
     */
    public function isBoolean()
    {
        return $this->getValue() === self::BOOLEAN;
    }
}

