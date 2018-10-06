<?php

namespace Slov\Expression\Type;

use DateInterval;


/** Тип интервал дат и времени */
class DateIntervalType extends Type
{

    const DATE_INTERVAL_CLASS = DateInterval::class;
    const DATE_INTERVAL_CREATE_FUNCTION = 'createFromDateString';

    /**
     * @param $code
     * @return string
     * @throws \Exception
     */
    public function toPhp($code)
    {
        preg_match('/^'. TypeRegExp::DATE_INTERVAL. '$/', $code, $match);
        $periodQuantity = $match[1];
        $periodType = $match[2];
        $periodTypeToName = [
            'day' => 'day',
            'days' => 'day'
        ];
        $periodName = $periodTypeToName[$periodType];
        return
            self::DATE_INTERVAL_CLASS.
            '::'.
            self::DATE_INTERVAL_CREATE_FUNCTION.
            '(\''.
            "$periodQuantity $periodName".
            '\')';
    }

}