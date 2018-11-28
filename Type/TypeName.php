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
}

