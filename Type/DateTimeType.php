<?php

namespace Slov\Expression\Type;

use DateTime;

/** Тип дата и время */
class DateTimeType extends Type
{
    public function getType()
    {
        return TypeName::byValue(TypeName::DATE_TIME);
    }

    /**
     * @return DateTime
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param DateTime $value
     * @return $this;
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление значения
     * @return DateTime значение
     */
    public function stringToValue($string)
    {
        preg_match('/^'. TypeRegExp::DATE_TIME. '$/', $string, $match);

        $date = $match[1];
        $time = isset($match[2]) && strlen($match[2]) > 0 ? $match[2] : ' 00:00:00';
        $microseconds = isset($match[3]) ? $match[3] : null;

        $dateTime = implode('', [$date, $time, $microseconds]);

        if(isset($microseconds)) {
            return DateTime::createFromFormat('Y.m.d H:i:s.u', $dateTime);
        }
        return DateTime::createFromFormat('Y.m.d H:i:s', $dateTime);
    }
}