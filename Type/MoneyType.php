<?php

namespace Slov\Expression\Type;

use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Helper\StringHelper;
use Slov\Money\Money;

/** Тип данных - деньги */
class MoneyType extends Type
{

    use SingleTemplate;

    const template = 'money';

    const templateFolder = 'type';

    public function getType()
    {
        return new TypeName(TypeName::MONEY);
    }

    /**
     * @return Money
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Money $value
     * @return $this;
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление значения
     * @return Money значение
     */
    public function stringToValue($string)
    {
        list($major, $minor) = explode('$', $string);
        $majorCurrencyParts = Money::getMajorCurrencyParts();
        $minorValue = (int)$major * $majorCurrencyParts + (int)$minor;
        return Money::create($minorValue);
    }

    public function generatePhpCode()
    {
        return StringHelper::replacePatterns(
            $this->getTemplate(),
            [
                '%amount%' => $this->getValue()->getAmount()
            ]
        );
    }
}