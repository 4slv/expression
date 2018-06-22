<?php

namespace Slov\Expression\Type;


class StringType extends Type
{
    /**
     * @return TypeName
     */
    function getType()
    {
        return new TypeName(TypeName::STRING);
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
     * @return string значение
     */
    public function stringToValue($string)
    {
        preg_match('/'.TypeRegExp::STRING.'/', $string,$out);
        return $out[1] ?? '';
    }

}