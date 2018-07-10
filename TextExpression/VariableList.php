<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Expression;
use Slov\Expression\Type\Type;

/** Список переменных */
class VariableList
{
    /** @var Expression[]|Type[] ассоциативный массив: название переменной => переменная (выражение или тип) */
    protected $list = [];

    /** добавление переменной в список
     * @param string $name название переменной
     * @param Expression|Type $value значение переменной
     * @return $this */
    public function append($name, $value)
    {
        $this->list[$name] = $value;
        return $this;
    }

    /**
     * @param string $name название переменной
     * @return bool true - переменная существует
     */
    public function exists($name)
    {
        return array_key_exists($name, $this->list);
    }

    /**
     * @param string $name название переменной
     * @return Expression|Type
     */
    public function get($name)
    {
        return $this->list[$name];
    }

    /**
     * Список всех переменных
     * @return Expression|Type
     */
    public function getAll()
    {
        return $this->list;
    }
}