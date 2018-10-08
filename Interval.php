<?php

namespace Slov\Expression;

use DateInterval;


class Interval
{

    const PROPERTY_LIST = [
        'y' => 'year',
        'm' => 'month',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minutes',
        's' => 'seconds',
        'f' => 'microseconds'];

    /** Сложение интервалов
     * @param DateInterval $leftInterval
     * @param DateInterval $rightInterval
     * @return DateInterval
     */
    public static function add(DateInterval $leftInterval, DateInterval $rightInterval)
    {
        $result = clone $leftInterval;
        foreach (self::PROPERTY_LIST as $name => $value)
        {
            $result->{$name} = $leftInterval->{$name} + $rightInterval->{$name};
        }
        return $result;
    }

    /** Вычитание интервалов
     * @param DateInterval $leftInterval
     * @param DateInterval $rightInterval
     * @return DateInterval
     */
    public static function sub(DateInterval $leftInterval, DateInterval $rightInterval)
    {
        $result = clone $leftInterval;
        foreach (self::PROPERTY_LIST as $name => $value)
        {
            $result->{$name} = $leftInterval->{$name} - $rightInterval->{$name};
        }
        return $result;
    }

    /**
     * @param DateInterval $leftInterval интервал слеав
     * @param DateInterval $rightInterval интервал справа
     * @return bool
     */
    public static function equal(DateInterval $leftInterval, DateInterval $rightInterval)
    {
        foreach (self::PROPERTY_LIST as $intervalType => $typeName){
            if($leftInterval->$intervalType !== $rightInterval->$intervalType)
                return false;
        }

        return true;
    }

    /**
     * @param DateInterval $leftInterval интервал слеав
     * @param DateInterval $rightInterval интервал справа
     * @return bool результат сравнения: true - если интервал  слева больше
     */
    public static function greater(DateInterval $leftInterval, DateInterval $rightInterval) : bool
    {
        foreach (self::PROPERTY_LIST as $intervalType => $typeName){
            if($leftInterval->$intervalType > $rightInterval->$intervalType)
                return true;
        }
        return false;
    }
}