<?php

namespace Slov\Expression\Type;


use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\Interfaces\CacheVariable;
use Slov\Helper\StringHelper;

class StringType extends Type implements CacheVariable
{


    use SingleTemplate;

    const template = 'string';

    const templateFolder = 'type';


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

    public function generatePhpCode(): string
    {
        return $this->render(
            ['value' => $this->getValue()]
        );
    }


}