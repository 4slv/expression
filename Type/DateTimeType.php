<?php

namespace Slov\Expression\Type;

use DateTime;

/** Тип дата и время */
class DateTimeType extends Type
{
    public function getType()
    {
        return new TypeName(TypeName::DATE_TIME);
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
        $dateInfo = explode(' ', $string);

        list($date, $time) = count($dateInfo) > 1
            ? $dateInfo
            : [current($dateInfo), null];
        if(is_null($time)){
            $time = '00:00:00';
        }
        $dateTime = implode(' ', [$date, $time]);

        return DateTime::createFromFormat(
            'Y.m.d H:i:s',
            $dateTime
        );
    }
}