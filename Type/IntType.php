<?php

namespace Slov\Expression\Type;

/** Тип целое число */
class IntType extends Type{

    /**
     * @return TypeName
     */
    function getType()
    {
        return new TypeName(TypeName::INT);
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return $this;
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление значения
     * @return int значение
     */
    public function stringToValue($string)
    {
        return (int)$string;
    }

}
