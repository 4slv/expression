<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Expression;

/** Операция с деньгами */
trait MoneyOperationTrait
{
    public function toPhpMoney($code = null): string
    {
        $class = get_called_class();
        return constant($class. '::MONEY_OPERATION');
    }

    /**
     * @return string шаблон операции с деньгами
     */
    public function getPhpTemplateMoney(): string
    {
        return
            Expression::FIRST_OPERAND.
            '->'. Expression::OPERATION.
            '('. Expression::SECOND_OPERAND. ')';
    }

    /**
     * @return string шаблон операции с деньгами
     */
    public function getPhpTemplateMoneyInverse(): string
    {
        return Expression::SECOND_OPERAND.
            '->'. Expression::OPERATION.
            '('.Expression::FIRST_OPERAND . ')';
    }

}