<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Type\TypeName;

/** Структура функции */
class FunctionStructure
{
    /** @var string название функции */
    protected $name;

    /** @var TypeName тип возвращаемого значения */
    protected $returnTypeName;

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
     * @return TypeName тип возвращаемого значения
     */
    public function getReturnTypeName(): TypeName
    {
        return $this->returnTypeName;
    }

    /**
     * @param TypeName $returnTypeName тип возвращаемого значения
     * @return $this
     */
    public function setReturnTypeName(TypeName $returnTypeName)
    {
        $this->returnTypeName = $returnTypeName;
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