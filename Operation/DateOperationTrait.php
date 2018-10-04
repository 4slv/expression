<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Expression;
use Slov\Expression\Type\DateIntervalType;

trait DateOperationTrait
{
    /**
     * @return string шаблон операций с интервалами
     */
    public function getPhpTemplateIntervalOperationInterval()
    {
        return
            DateIntervalType::DATE_INTERVAL_CLASS.
            '::'.
            DateIntervalType::DATE_INTERVAL_CREATE_FUNCTION.
            '(\''.
            Expression::FIRST_OPERAND.
            ' '.
            Expression::OPERATION.
            ' '.
            Expression::SECOND_OPERAND.
            '\')';
    }

    /**
     * @return string шаблон операции даты с интервалом
     */
    public function getPhpTemplateDateOperationInterval()
    {
        return Expression::FIRST_OPERAND.
        '->'.
        Expression::OPERATION.
        '('.
        DateIntervalType::DATE_INTERVAL_CLASS.
        '::'.
        DateIntervalType::DATE_INTERVAL_CREATE_FUNCTION.
        '(\''.
        Expression::SECOND_OPERAND.
        '\'))';
    }
}