<?php

namespace Slov\Expression\Structure;

/** Структура массив */
class ArrayStructure
{
    /** @var array массив */
    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /** Получение элемента массива по ключу
     * @param int|string $key ключ массива
     * @return mixed
     */
    public function get($key)
    {
        return $this->exists($key)
                ? $this->array[$key]
                : null;
    }

    /** Запись элемента массива по ключу
     * @param $key
     * @param $value
     */
    public function set($key, $value): void
    {
        $this->array[$key] = $value;
    }

    /** Проверка существования ключа в массиве
     * @param int|string $key ключ массива
     * @return bool
     */
    public function exists($key): bool
    {
        return array_key_exists($key, $this->array);
    }

    /**
     * Сброс указателя массива на первый элемент
     * @return mixed первый элемент массива
     */
    public function reset()
    {
        return reset($this->array);
    }

    /**
     * Сброс указателя массива на последний элемент
     * @return mixed последний элемент массива
     */
    public function end()
    {
        return reset($this->array);
    }

    /**
     * Передвинуть указатель массива вперёд
     * @return mixed следующий элмент массива
     */
    public function next()
    {
        return next($this->array);
    }

    /**
     * Передвинуть указатель массива назад
     * @return mixed предыдущий элемент массива
     */
    public function prev()
    {
        return prev($this->array);
    }

    /**
     * @return mixed ключ элемента на котором находится указатель массива
     */
    public function key()
    {
        return key($this->array);
    }

    /**
     * @return int размер массива
     */
    public function count()
    {
        return count($this->array);
    }
}