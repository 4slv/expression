<?php

namespace Slov\Expression\Type\Interfaces;

use Slov\Expression\Interfaces\Operand;
use Slov\Expression\Type\TypeName;
use Slov\Money\Money;
use DateTime;
use DateInterval;

/** Интерфейс типа */
interface Type extends  Operand
{
    /**
     * @return int|float|Money|DateTime|DateInterval|null|boolean
     */
    public function getValue();

    /**
     * @param int|float|Money|DateTime|DateInterval|null|boolean $value
     * @return $this
     */
    public function setValue($value);

    /**
     * @return TypeName название типа
     */
    public function getType();

    /**
     * @param string $string строковое представление значения
     * @return int|float|Money|DateTime|DateInterval|null значение
     */
    public function stringToValue($string);
}