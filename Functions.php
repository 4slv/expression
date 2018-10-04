<?php

namespace Slov\Expression;

use DateTime;

/** Встроенные функции */
class Functions
{
    /** Преобразование к дате
     * @param DateTime $dateTime дата со временем
     * @return DateTime дата без времени
     */
    public static function date($dateTime)
    {
        $returnDate = clone $dateTime;
        $returnDate->setTime(0,0,0,0);
        return $returnDate;
    }

    /** Определение числа дней в году
     * @param DateTime $dateTime дата со временем
     * @return int число дней в году
     */
    public static function daysInYear($dateTime)
    {
        $date = clone $dateTime;
        $dateYear = (int)$date->format('Y');

        $dateBegin = $date
            ->setDate($dateYear, 0, 0)
            ->setTime(0,0,0);

        $dateEnd = clone $dateBegin;
        $dateEnd->modify('+1 year');

        return $dateEnd->diff($dateBegin)->days;
    }
}