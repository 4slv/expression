<?php

namespace Slov\Expression\Type;

use Slov\Money\Money;

/** Тип данных - деньги */
class MoneyType extends Type
{
    const MONEY_CLASS = Money::class;

    public function toPhp($code)
    {
        preg_match('#'. TypeRegExp::MONEY. '#', $code, $match);
        $moneyAmount =
            (int)$match[1] * Money::getMajorCurrencyParts()
            +
            (int)$match[2];
        return self::MONEY_CLASS. '('. $moneyAmount. ')';
    }
}