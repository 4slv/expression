<?php

namespace Slov\Expression\Type;

use DateInterval;
use Exception;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Helper\StringHelper;

/** Тип интервал дат и времени */
class DateIntervalType extends Type
{
    use SingleTemplate;

    const template = 'date_interval';

    const templateFolder = 'type';

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
 * @return DateInterval результат вычитания временных интервалов
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

    /**
     * @param DateInterval $intervalFirst первый временной интервал
     * @param DateInterval $intervalSecond второй временной интервал
     * @return bool результат сравнения: true - если интервалы равны
     */
    public static function equal(DateInterval $intervalFirst, DateInterval $intervalSecond) : bool
    {
        foreach (self::$intervalTypeList as $intervalType){
            if($intervalFirst->$intervalType !== $intervalSecond->$intervalType)
                return false;
        }

        return true;
    }

    /**
     * @param DateInterval $intervalFirst первый временной интервал
     * @param DateInterval $intervalSecond второй временной интервал
     * @return bool результат сравнения: true - если первый интервал больше
     */
    public static function greater(DateInterval $intervalFirst, DateInterval $intervalSecond) : bool
    {
        foreach (self::$intervalTypeList as $intervalType){
            if($intervalFirst->$intervalType > $intervalSecond->$intervalType)
                return true;
        }

        return false;
    }

    /**
     * @param DateInterval $intervalFirst первый временной интервал
     * @param DateInterval $intervalSecond второй временной интервал
     * @return bool результат сравнения: true - если первый интервал меньше
     */
    public static function less(DateInterval $intervalFirst, DateInterval $intervalSecond) : bool
    {
        foreach (self::$intervalTypeList as $intervalType){
            if($intervalFirst->$intervalType < $intervalSecond->$intervalType)
                return true;
        }

        return false;
    }

    /**
     * @param DateInterval $intervalFirst первый временной интервал
     * @param DateInterval $intervalSecond второй временной интервал
     * @return bool результат сравнения: true - если первый интервал больше или равен второму
     */
    public static function greaterOrEqual(DateInterval $intervalFirst, DateInterval $intervalSecond) : bool
    {
        foreach (self::$intervalTypeList as $intervalType){
            if($intervalFirst->$intervalType < $intervalSecond->$intervalType)
                return false;
        }

        return true;
    }

    /**
     * @param DateInterval $intervalFirst первый временной интервал
     * @param DateInterval $intervalSecond второй временной интервал
     * @return bool результат сравнения: true - если первый интервал меньше или равен второму
     */
    public static function lessOrEqual(DateInterval $intervalFirst, DateInterval $intervalSecond) : bool
    {
        foreach (self::$intervalTypeList as $intervalType){
            if($intervalFirst->$intervalType > $intervalSecond->$intervalType)
                return false;
        }

        return true;
    }

    public function generatePhpCode(): string
    {
        return StringHelper::replacePatterns(
            $this->getTemplate(),
            ['%interval%' => $this->getValue()->format('P%yY%mM%dDT%hH%iM%sS')]
        );
    }
}