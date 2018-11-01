<?php

namespace Slov\Expression\Expression;


/** Список переменных */
class VariableList
{
    /** @var VariableStructure[] ассоциативный массив: название переменной => переменная */
    protected $list = [];

    /** добавление переменной в список
     * @param string $name название переменной
     * @param VariableStructure $value значение переменной
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
     * @return VariableStructure
     */
    public function get($name)
    {
        return $this->list[$name];
    }

    /**
     * Список всех переменных
     * @return VariableStructure[]
     */
    public function getAll()
    {
        return $this->list;
    }
}