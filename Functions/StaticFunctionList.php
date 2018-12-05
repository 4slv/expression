<?php

namespace Slov\Expression\Functions;


use Slov\Expression\Code\CodeParseException;


/** Список статических функций */
class StaticFunctionList
{
    /** @var callable[] ассоциативный массив вида: название => функция */
    protected static $list = [];

    protected function __construct(){}

    /** Опустошить список функций */
    public static function emptyList(): void
    {
        self::$list = [];
    }

    /**
     * Проверка существования функции
     * @param string $name название функции
     * @return bool
     */
    public static function exists(string $name): bool
    {
        return array_key_exists($name, self::$list);
    }

    /**
     * Добавление функции в список
     * @param callable $function добавляемая функция
     * @param string $name название функции
     * @throws CodeParseException
     */
    public static function append(callable $function, string $name): void
    {
        if(self::exists($name) === false)
        {
            self::$list[$name] = $function;
        } else {
            throw new CodeParseException($name. ' :: function already defined');
        }

    }

    /**
     * Получение функции по названию
     * @param string $name название функции
     * @return callable функция
     * @throws CodeParseException
     */
    public static function get(string $name): callable
    {
        if(self::exists($name))
        {
            return self::$list[$name];
        }
        throw new CodeParseException($name. ' :: function does not defined');
    }

    /**
     * Запуск указанной функции
     * @param string $name название функции
     * @param array $parameters параметры функции
     * @return mixed
     * @throws CodeParseException
     */
    public static function call(string $name, array $parameters)
    {
        return call_user_func_array(
            self::get($name),
            $parameters
        );
    }
}