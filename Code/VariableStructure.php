<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Type\TypeName;

class VariableStructure
{
    /** @var string название переменной */
    private $name;

    /** @var string псевдокод инициализации переменной */
    private $code;

    /** @var TypeName тип переменной */
    private $typeName;

    /** @var string php код */
    private $php;

    /**
     * @return string название переменной
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name название переменной
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string псевдокод инициализации переменной
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code псевдокод инициализации переменной
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return TypeName тип переменной
     */
    public function getTypeName(): TypeName
    {
        return $this->typeName;
    }

    /**
     * @param TypeName $typeName тип переменной
     * @return $this
     */
    public function setTypeName(TypeName $typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }

    /** @return string php код */
    public function getPhp(): string
    {
        return $this->php;
    }

    /**
     * @param string $php php код
     * @return $this
     */
    public function setPhp(string $php)
    {
        $this->php = $php;
        return $this;
    }
}