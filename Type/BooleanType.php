<?php

namespace Slov\Expression\Type;

use Slov\Expression\TemplateProcessor\SingleTemplate;

/** Булев тип */
class BooleanType extends Type
{

    use SingleTemplate;

    const template = 'bool';

    const templateFolder = 'type';

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
        return $string === 'true' ? true : false;
    }

    public function generatePhpCode(): string
    {
        return $this->render( ['value' => $this->getValue() ? 'true':'false']);
    }

}
