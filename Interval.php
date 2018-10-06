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
    public function sub(DateInterval $leftInterval, DateInterval $rightInterval)
    {
        $result = clone $leftInterval;
        foreach (self::PROPERTY_LIST as $name => $value)
        {
            $result->{$name} = $leftInterval->{$name} - $rightInterval->{$name};
        }
        return $result;
    }

}