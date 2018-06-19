<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Expression;

/** Список выражений */
class ExpressionList
{
    /** @var Expression[] ассоциативный массив: название выражения => выражения */
    protected $list = [];

    /** добавление выражения в список
     * @param string $name название выражения
     * @param Expression $value выражение
     * @return $this */
    public function append($name, $value)
    {
        $this->list[$name] = $value;
        return $this;
    }

    /**
     * @param string $name название выражения
     * @return bool true - выражение существует
     */
    public function exists($name)
    {
        return array_key_exists($name, $this->list);
    }

    /**
     * @param string $name название выражения
     * @return Expression
     */
    public function get($name)
    {
        return $this->list[$name];
    }

    /**
     * @return int размер списка выражений
     */
    public function size()
    {
        return count($this->list);
    }
}