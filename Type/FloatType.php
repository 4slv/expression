<?php

namespace Slov\Expression\Type;

use Slov\Expression\TemplateProcessor\SingleTemplate;

/** Тип число с плавающей запятой */
class FloatType extends Type {

    use SingleTemplate;

    const template = 'float';

    const templateFolder = 'type';

    /**
     * @return TypeName
     */
    function getType()
    {
        return new TypeName(TypeName::FLOAT);
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление значения
     * @return float значение
     */
    public function stringToValue($string)
    {
        return (float)$string;
    }

    /**
     * @return string
     */
    public function generatePhpCode(): string
    {
        return $this->render(['value' => $this->getValue()]);
    }

}
