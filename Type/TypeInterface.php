<?php

namespace Slov\Expression\Type;

use Slov\Money\Money;
use DateTime;
use DateInterval;

/** Интерфейс типа */
interface TypeInterface
{
    /**
     * @return int|float|Money|DateTime|DateInterval|null
     */
    public function getValue();

    /**
     * @param int|float|Money|DateTime|DateInterval|null $value
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