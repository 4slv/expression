<?php

namespace Slov\Expression\TextExpression;

/** Структура функции */
class FunctionStructure
{
    /** @var string название функции */
    protected $name;

    /** @var callable функция */
    protected $function;

    /**
     * @return string название функции
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name название функции
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return callable функция
     */
    public function getFunction(): callable
    {
        return $this->function;
    }

    /**
     * @param callable $function функция
     * @return $this
     */
    public function setFunction(callable $function)
    {
        $this->function = $function;
        return $this;
    }
}