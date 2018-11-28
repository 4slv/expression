<?php

namespace Slov\Expression\Type;

use Slov\Expression\Code\CodeContext;
use Slov\Money\Money;

/** Тип деньги */
class MoneyType extends Type
{

    const MONEY_CLASS = Money::class;
    const MONEY_CREATE_FUNCTION = 'create';

    public function toPhp(CodeContext $codeContext): string
    {
        list($major, $minor) = explode('$', $this->getCodeTrim());
        $moneyAmount = (int)$major * Money::getMajorCurrencyParts() + (int)$minor;
        return self::MONEY_CLASS. '::'. self::MONEY_CREATE_FUNCTION. '('. $moneyAmount. ')';
    }
}