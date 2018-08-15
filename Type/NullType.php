<?php

namespace Slov\Expression\Type;


use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Helper\StringHelper;

class NullType extends Type
{

    use SingleTemplate;

    const template = 'null';

    const templateFolder = 'type';
    /**
     * @return TypeName
     */
    public function getType()
    {
        return new TypeName(TypeName::NULL);
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление значения
     * @return null значение
     */
    public function stringToValue($string)
    {
        return null;
    }

    public function generatePhpCode(): string
    {
        return StringHelper::replacePatterns(
            $this->getTemplate(),
            []
        );
    }

}