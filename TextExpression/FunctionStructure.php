<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Type\TypeName;

/** Структура функции */
class FunctionStructure
{
    /** @var string название функции */
    protected $name;

    /** @var callable функция */
    protected $function;

    /** @var  TypeName */
    protected $returnType;

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

    /**
     * @return TypeName|null
     */
    public function getReturnType(): TypeName
    {
        if(is_null($this->returnType))
            return TypeName::UNKNOWN();
        return $this->returnType;
    }

    /**
     * @param TypeName $returnType
     * @return $this
     */
    public function setReturnType(TypeName $returnType)
    {
        $this->returnType = $returnType;
        return $this;
    }


}