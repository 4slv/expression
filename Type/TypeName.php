<?php

namespace Slov\Expression\Type;

use MabeEnum\Enum;

/** Название типа */
class TypeName extends Enum
{
    const INT = 'int';
    const FLOAT = 'float';

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
}

