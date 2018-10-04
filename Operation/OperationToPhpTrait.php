<?php

namespace Slov\Expression\Operation;

/** Преобразователь операций в php код */
trait OperationToPhpTrait
{
    public function toPhpSameCode($code = null): string
    {
        return $code;
    }

    public function toPhpDateInterval($code = null): string
    {
        $class = get_called_class();
        return constant($class. '::DATE_INTERVAL_OPERATION');
    }

    public function toPhpDatetime($code = null): string
    {
        $class = get_called_class();
        return constant($class. '::DATETIME_OPERATION');
    }

    public function toPhpMoney($code = null): string
    {
        $class = get_called_class();
        return constant($class. '::MONEY_OPERATION');
    }

    public function toPhpInlineFunction():string
    {
        $class = get_called_class();
        return constant($class. '::INLINE_FUNCTION_OPERATION');
    }
}