<?php

namespace Slov\Expression\Type;

use DateInterval;
use Exception;

/** Тип интервал дат и времени */
class DateIntervalType extends Type
{
    protected static $intervalTypeList = ['y', 'm', 'd', 'h', 'i', 's'];

    /**
     * @return TypeName название типа
     */
    public function getType()
    {
        return new TypeName(TypeName::DATE_INTERVAL);
    }

    /**
     * @return DateInterval
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param DateInterval $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление значения
     * @return DateInterval значение
     * @throws Exception
     */
    public function stringToValue($string)
    {
        preg_match('/^'. TypeRegExp::DATE_INTERVAL. '$/', $string, $match);
        $periodQuantity = $match[1];
        $periodType = $match[2];
        $periodTypeToSign = [
            'day' => 'D',
            'days' => 'D'
        ];
        $periodSign = $periodTypeToSign[$periodType];
        return new DateInterval('P'. $periodQuantity. $periodSign);
    }

    /**
     * @param DateInterval $intervalFirst первый временной интервал
     * @param DateInterval $intervalSecond второй временной интервал
     * @return DateInterval результат сложения временных интервалов
     */
    public static function add(DateInterval $intervalFirst, DateInterval $intervalSecond)
    {
        $intervalResult = new DateInterval('P0D');
        foreach (self::$intervalTypeList as $intervalType){
            $intervalResult->$intervalType =
                $intervalFirst->$intervalType
                +
                $intervalSecond->$intervalType;
        }
        return $intervalResult;
    }

    /**
     * @param DateInterval $intervalFirst первый временной интервал
     * @param DateInterval $intervalSecond второй временной интервал
     * @return DateInterval результат сложения временных интервалов
     */
    public static function sub(DateInterval $intervalFirst, DateInterval $intervalSecond)
    {
        $intervalResult = new DateInterval('P0D');
        foreach (self::$intervalTypeList as $intervalType){
            $intervalResult->$intervalType =
                $intervalFirst->$intervalType
                -
                $intervalSecond->$intervalType;
        }

        return $intervalResult;
    }
}