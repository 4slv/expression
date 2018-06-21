<?php

namespace Slov\Expression\Type;

/** Булев тип */
class BooleanType extends Type{

    /**
     * @return TypeName
     */
    function getType() : TypeName
    {
        return new TypeName(TypeName::BOOLEAN);
    }

    /**
     * @return bool
     */
    public function getValue() : bool
    {
        return $this->value;
    }

    /**
     * @param bool $value
     * @return $this;
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление значения
     * @return bool значение
     */
    public function stringToValue($string) : bool
    {
        return (bool)$string;
    }

}
