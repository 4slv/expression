<?php

namespace Slov\Expression\Type;


use Slov\Expression\TemplateProcessor\TemplateProcessor;
use Slov\Expression\Type\Interfaces\CacheVariable;
use Slov\Helper\StringHelper;

class StringType extends Type implements CacheVariable
{


    const template = 'string_type';

    const templateFolder = 'type';

    /**
     * @return bool|string
     */
    protected function getTemplate()
    {

        return TemplateProcessor::getInstance()
            ->getTemplateByName(static::template,[static::templateFolder]);
    }

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
        return StringHelper::replacePatterns(
            $this->getTemplate(),
            ['%value%' => "'".$this->getValue()."'"]
        );
    }


}