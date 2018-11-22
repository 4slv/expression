<?php

namespace Slov\Expression\Type;

use Slov\Money\Money;

/** Тип данных - деньги */
class MoneyType extends Type
{
    public function getType()
    {
        return TypeName::byValue(TypeName::MONEY);
    }

    /**
     * @return Money
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Money $value
     * @return $this;
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление значения
     * @return Money значение
     */
    public function stringToValue($string)
    {
        list($major, $minor) = explode('$', $string);
        $majorCurrencyParts = Money::getMajorCurrencyParts();
        $minorValue = (int)$major * $majorCurrencyParts + (int)$minor;
        return Money::create($minorValue);
    }
}