<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Expression;
use Slov\Expression\Functions;
use Slov\Expression\Type\DateIntervalType;

/** Хранилище шаблонов */
trait OperationPhpTemplateTrait
{
    /**
     * @return string шаблон операции с примитивными типами
     */
    protected function getPhpTemplatePrimitive(): string
    {
        return implode(
            ' ',
            [
                Expression::FIRST_OPERAND,
                Expression::OPERATION,
                Expression::SECOND_OPERAND
            ]
        );
    }

    /**
     * @return string шаблон операции с объектами
     */
    protected function getPhpTemplateObject()
    {
        return
            Expression::FIRST_OPERAND.
            '->'. Expression::OPERATION.
            '('. Expression::SECOND_OPERAND. ')';
    }

    /**
     * @return string инвертированный шаблон операции с объектами
     */
    protected function getPhpTemplateObjectInverse(): string
    {
        return Expression::SECOND_OPERAND.
            '->'. Expression::OPERATION.
            '('.Expression::FIRST_OPERAND . ')';
    }

    /**
     * @return string шаблон операции со встроенной функцией
     */
    protected function getPhpTemplateInlineFunction(): string
    {
        return Functions::class.
            '::'.
            Expression::OPERATION.
            '('.Expression::SECOND_OPERAND . ')';
    }

    /**
     * @return string шаблон операции со встроенной функцией и интервалом в качестве параметра
     */
    protected function getPhpTemplateInlineFunctionWithIntervalParameter(): string
    {
        return Functions::class.
            '::'.
            Expression::OPERATION.
            '('.
            DateIntervalType::DATE_INTERVAL_CLASS.
            '::'.
            DateIntervalType::DATE_INTERVAL_CREATE_FUNCTION.
            '(\''.
            Expression::SECOND_OPERAND.
            '\')'.
            ')';
    }
}