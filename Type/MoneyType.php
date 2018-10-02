<?php

namespace Slov\Expression\Type;

use Slov\Money\Money;

/** Тип данных - деньги */
class MoneyType extends Type
{
    const MONEY_CLASS = Money::class;
    const MONEY_CREATE_FUNCTION = 'create';

    public function toPhp($code)
    {
        list($major, $minor) = explode('$', $code);
        $moneyAmount = (int)$major * Money::getMajorCurrencyParts() + (int)$minor;
        return self::MONEY_CLASS. '::'. self::MONEY_CREATE_FUNCTION. '('. $moneyAmount. ')';
    }
}