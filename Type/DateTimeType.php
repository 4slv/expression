<?php

namespace Slov\Expression\Type;

use DateTime;

/** Тип дата и время */
class DateTimeType extends Type
{
    const DATETIME_CLASS = DateTime::class;
    const DATETIME_CREATE_FUNCTION = 'createFromFormat';

    public function toPhp($code)
    {
        preg_match('/^'. TypeRegExp::DATE_TIME. '$/', $code, $match);

        $date = $match[1];
        $time = isset($match[2]) && strlen($match[2]) > 0 ? $match[2] : ' 00:00:00';
        $microseconds = isset($match[3]) ? $match[3] : null;

        $dateTime = implode('', [$date, $time, $microseconds]);

        $createDatetimeFunction = self::DATETIME_CLASS. '::'. self::DATETIME_CREATE_FUNCTION;

        if(isset($microseconds)) {
            return $createDatetimeFunction. "('Y.m.d H:i:s.u', '". $dateTime. "')";
        }
        return $createDatetimeFunction. "('Y.m.d H:i:s', '". $dateTime. "')";
    }
}