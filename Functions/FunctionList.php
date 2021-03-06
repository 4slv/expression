<?php

namespace Slov\Expression\Functions;

use Slov\Expression\Code\CodeParseException;

/** Список функций */
class FunctionList
{
    /** @var callable[] ассоциативный массив вида: название => функция */
    protected $list = [];

    /**
     * Проверка существования функции
     * @param string $name название функции
     * @return bool
     */
    public function exists(string $name): bool
    {
        return array_key_exists($name, $this->list);
    }

    /**
     * Добавление функции в список
     * @param callable $function добавляемая функция
     * @param string $name название функции
     * @throws CodeParseException
     */
    public function append(callable $function, string $name): void
    {
        if($this->exists($name) === false)
        {
            $this->list[$name] = $function;
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
    public function get(string $name): callable
    {
        if($this->exists($name))
        {
            return $this->list[$name];
        }
        throw new CodeParseException($name. ' :: function does not defined');
    }

    /**
     * @return callable[] ассоциативный массив вида: название => функция
     */
    public function getList(): array
    {
        return $this->list;
    }
}