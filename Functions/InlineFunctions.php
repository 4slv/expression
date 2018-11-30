<?php

namespace Slov\Expression\Functions;

use DateInterval;
use DateTime;

/** Встроенные функции */
class InlineFunctions
{
    /**
     * Преобразователь интервала в количество дей и обратно
     * @param DateInterval|int $days интервал или количество дней
     * @return DateInterval|int количество дней или интервал
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
            return DateInterval::createFromDateString($days. " day");
        }
    }
}