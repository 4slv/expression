<?php

namespace Slov\Expression;

use DateInterval;
use DateTime;
use Exception;
use Slov\Money\Money;

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

    /** Преобразователь интервала в количество дей и обратно
     * @param DateInterval|int $days интервал или количество дней
     * @return DateInterval|int количество дней или интервал
     * @throws Exception
     */
    public static function days($days)
    {
        if($days instanceof DateInterval) {
            /** Операция определения количества дней в интервале */
            if($days->days === false){
                $seconds = (new DateTime())
                    ->setTimeStamp(0)
                    ->add($days)
                    ->getTimeStamp();
                $days = $seconds / 86400;
                return (int) $days;
            } else {
                return $days->days;
            }
        } else {
            /** Преобразование целого числа во временной интервал */
            return DateInterval::createFromDateString($days . " day");
        }
    }

    /** Получение первой даты года
     * @param DateTime $date дата
     * @return DateTime
     */
    public static function firstYearDay(DateTime $date)
    {
        return (new DateTime())
            ->setDate($date->format('Y'), 1, 1)
            ->setTime(0,0,0);
    }

    /** Приведение к целому числу
     * @param float|Money $number
     * @return int */
    public static function int($number)
    {
        if(is_object($number) && $number instanceof Money){
            return $number->getAmount();
        }
        return (int) $number;
    }

    /**
     * @param int $amount сумма в минорных единицах
     * @return Money деньги
     */
    public static function money($amount)
    {
        return Money::create($amount);
    }
}