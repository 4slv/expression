<?php
/**
 * Created by PhpStorm.
 * User: r.shustrov
 * Date: 2018-06-21
 * Time: 12:39 PM
 */

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
        return (string)$string;
    }

}