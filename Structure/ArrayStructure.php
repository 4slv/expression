<?php

namespace Slov\Expression\Structure;

/** Массив */
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
    public function exists($key)
    {
        return array_key_exists($key, $this->array);
    }
}