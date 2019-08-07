<?php

namespace Slov\Expression\Functions;

use DateInterval;
use DateTime;
use Slov\Expression\Code\CodeRunException;
use Slov\Expression\Structure\ArrayStructure;
use Slov\Money\Money;

/** Встроенные функции */
class InlineFunctions
{
    /**
     * Преобразование к дате
     * @param DateTime $dateTime дата со временем
     * @return DateTime дата без времени
     */
    public static function date($dateTime)
    {
        $returnDate = clone $dateTime;
        $returnDate->setTime(0,0,0,0);
        return $returnDate;
    }

    /**
     * Определение числа дней в году
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

    /**
     * Получение первой даты года
     * @param DateTime $date дата
     * @return DateTime
     */
    public static function firstYearDay(DateTime $date)
    {
        return (new DateTime())
            ->setDate($date->format('Y'), 1, 1)
            ->setTime(0,0,0);
    }

    /**
     * Приведение к целому числу
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

    /**
     * Получение наименьшего элемента в списке
     * @param mixed $element, ... неограниченное кол-во элементов
     * @return mixed|Money
     * @throws CodeRunException
     */
    public static function min($element){
        /** @var mixed[] $list список сравниваемых параметров */
        $list = func_get_args();
        if(count($list) === 0){
            throw new CodeRunException('function min :: expected at least one parameter');
        }
        $firstElement = current($list);
        $firstElementType = is_object($firstElement)
            ? get_class($firstElement)
            : gettype($firstElement);
        foreach($list as $number => $element){
            $elementType = is_object($element)
                ? get_class($element)
                : gettype($element);
            if($firstElementType !== $elementType){
                throw new CodeRunException(
                    "function min :: $number parameter is $elementType ($firstElementType expected)"
                );
            }
        }
        if(is_object($firstElement) && $firstElement instanceof Money)
        {
            /** @var Money[] $list список сравниваемых параметров */
            return Money::min($list);
        }
        return min($list);
    }

    /**
     * Получение наибольшего элемента в списке
     * @param mixed $element, ... неограниченное кол-во элементов
     * @return mixed|Money
     * @throws CodeRunException
     */
    public static function max($element){
        /** @var mixed[] $list список сравниваемых параметров */
        $list = func_get_args();
        if(count($list) === 0){
            throw new CodeRunException('function max :: expected at least one parameter');
        }
        $firstElement = current($list);
        $firstElementType = is_object($firstElement)
            ? get_class($firstElement)
            : gettype($firstElement);
        foreach($list as $number => $element){
            $elementType = is_object($element)
                ? get_class($element)
                : gettype($element);
            if($firstElementType !== $elementType){
                throw new CodeRunException(
                    "function max :: $number parameter is $elementType ($firstElementType expected)"
                );
            }
        }
        if(is_object($firstElement) && $firstElement instanceof Money)
        {
            /** @var Money[] $list список сравниваемых параметров */
            return Money::max($list);
        }
        return max($list);
    }

    /**
     * @param mixed $element проверяемый параметр
     * @return bool true, если значение $element равно null
     */
    public static function isNull($element)
    {
        return is_null($element);
    }

    /**
     * @param mixed $element проверяемый параметр
     * @return bool false, если значение $element равно null
     */
    public static function isNotNull($element)
    {
        return isset($element);
    }

    /**
     * @param mixed $element, ... неограниченное кол-во элементов
     * @return ArrayStructure массив
     */
    public static function array($element = null)
    {
        /** @var mixed[] $list список элементов */
        $list = func_get_args();
        return new ArrayStructure($list);
    }

    /** Получение значения массива по ключу
     * @param ArrayStructure $array структура массив
     * @param int|string $key ключ массива
     * @return mixed
     * @throws CodeRunException
     */
    public static function getArrayValue(ArrayStructure $array, $key)
    {
        if($array->exists($key) === false)
        {
            throw new CodeRunException(
                "function getArrayValue :: key $key not exists in array"
            );
        }
        return $array->get($key);
    }

    /** Записать значение в массив по ключу
     * @param ArrayStructure $array структура массив
     * @param int|string $key ключ массива
     * @param int|string $value элемент массива
     */
    public static function setArrayValue(ArrayStructure $array, $key, $value)
    {
        $array->set($key, $value);
    }

    /** Проверка существования ключа в массиве
     * @param int|string $key искомый ключ
     * @param ArrayStructure $array структура массив
     * @return bool true - ключ присутствует в массиве, false - нет
     */
    public static function arrayKeyExists($key, ArrayStructure $array)
    {
        return $array->exists($key);
    }

    /** Сброс указателя массива на первый элемент
     * @param ArrayStructure $array структура массив
     * @return mixed первый элемент массива
     */
    public static function reset(ArrayStructure $array)
    {
        return $array->reset();
    }

    /** Сброс указателя массива на последний элемент
     * @param ArrayStructure $array структура массив
     * @return mixed последний элемент массива
     */
    public static function end(ArrayStructure $array)
    {
        return $array->end();
    }

    /** Передвинуть указатель массива вперёд
     * @param ArrayStructure $array структура массив
     * @return mixed следующий элмент массива
     */
    public static function next(ArrayStructure $array)
    {
        return $array->next();
    }

    /** Передвинуть указатель массива назад
     * @param ArrayStructure $array структура массив
     * @return mixed предыдущий элемент массива
     */
    public static function prev(ArrayStructure $array)
    {
        return $array->prev();
    }

    /**
     * @param ArrayStructure $array структура массив
     * @return int|string|null ключ элемента на котором находится указатель массива
     */
    public static function key(ArrayStructure $array)
    {
        return $array->key();
    }

    /**
     * @param ArrayStructure $array структура массив
     * @return int размер массива
     */
    public static function count(ArrayStructure $array)
    {
        return $array->count();
    }

    /**
     * Округление до ближайшего меньшего целого (для денег до мажорных единиц)
     * @param float|Money $value
     * @return int|Money
     */
    public static function floor($value)
    {
        if(is_object($value) && $value instanceof Money)
        {
            $majorCurrencyAmount = $value->getAmount() / Money::getMajorCurrencyParts();
            return Money::create(
                floor($majorCurrencyAmount)
                *
                Money::getMajorCurrencyParts()
            );
        }

        if(is_float($value) || is_int($value)){
            return floor($value);
        }

        return $value;
    }

    /**
     * Округление до ближайшего большего целого (для денег до мажорных единиц)
     * @param float|Money $value
     * @return int|Money
     */
    public static function ceil($value)
    {
        if(is_object($value) && $value instanceof Money)
        {
            $majorCurrencyAmount = $value->getAmount() / Money::getMajorCurrencyParts();
            return Money::create(
                ceil($majorCurrencyAmount)
                *
                Money::getMajorCurrencyParts()
            );
        }

        if(is_float($value) || is_int($value)){
            return ceil($value);
        }

        return $value;
    }

    /**
     * Округление по математическим правилам (для денег до мажорных единиц)
     * @param float|Money $value
     * @return int|Money
     */
    public static function round($value)
    {
        if(is_object($value) && $value instanceof Money)
        {
            $majorCurrencyAmount = $value->getAmount() / Money::getMajorCurrencyParts();
            return Money::create(
                round($majorCurrencyAmount)
                *
                Money::getMajorCurrencyParts()
            );
        }

        if(is_float($value) || is_int($value)){
            return round($value);
        }

        return $value;
    }

    /**
     * Сортировка элементы массива в порядке возрастания
     * @param ArrayStructure $arrayStructure структура массива
     * @return ArrayStructure структура массива с отсортированными элементами
     */
    public static function sort(ArrayStructure $arrayStructure)
    {
        $array = $arrayStructure->getArray();
        sort($array);
        return new ArrayStructure($array);
    }

    /**
     * Сортировка элементы массива в порядке убвыания
     * @param ArrayStructure $arrayStructure структура массива
     * @return ArrayStructure структура массива с отсортированными элементами
     */
    public static function rsort(ArrayStructure $arrayStructure)
    {
        $array = $arrayStructure->getArray();
        rsort($array);
        return new ArrayStructure($array);
    }

    /**
     * Сортировка ключей массива в порядке возрастания
     * @param ArrayStructure $arrayStructure структура массива
     * @return ArrayStructure структура массива с отсортированными ключами
     */
    public static function asort(ArrayStructure $arrayStructure)
    {
        $array = $arrayStructure->getArray();
        asort($array);
        return new ArrayStructure($array);
    }

    /**
     * Сортировка ключей массива в порядке убвыания
     * @param ArrayStructure $arrayStructure структура массива
     * @return ArrayStructure структура массива с отсортированными ключами
     */
    public static function arsort(ArrayStructure $arrayStructure)
    {
        $array = $arrayStructure->getArray();
        arsort($array);
        return new ArrayStructure($array);
    }

    /**
     * Получение ключей массива
     * @param ArrayStructure $arrayStructure структура массива
     * @return ArrayStructure ключи массива
     */
    public static function arrayKeys(ArrayStructure $arrayStructure)
    {
        $array = $arrayStructure->getArray();
        return new ArrayStructure(array_keys($array));
    }

    /**
     * Вывести значение $value с помощью функции print_r
     * @param mixed $value значение
     */
    public static function printR($value)
    {
        print_r($value);
    }

    /**
     * Вывести значение $value с помощью функции var_dump
     * @param mixed $value значение
     */
    public static function varDump($value)
    {
        var_dump($value);
    }
}