<?php

namespace Slov\Expression\Type;

use MabeEnum\Enum;

/** Название типа */
class TypeName extends Enum
{
    const INT = 'int';
    const FLOAT = 'float';
    const BOOLEAN = 'boolean';
    const MONEY = 'money';
    const DATE_TIME = 'dateTime';
    const DATE_INTERVAL = 'dateInterval';
    const NULL = 'null';

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
     * @return bool true - является числом с плавающей запятой
     */
    public function isFloat()
    {
        return $this->getValue() === self::FLOAT;
    }

    /**
     * @return bool true - тип boolean
     */
    public function isBoolean()
    {
        return $this->getValue() === self::BOOLEAN;
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
     * @return boolean true - тип: отсутствие значения
     */
    public function isNull()
    {
        return $this->getValue() === self::NULL;
    }
}

