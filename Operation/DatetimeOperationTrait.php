<?php

namespace Slov\Expression\Operation;

/** Операция с временным интервалом */
trait DatetimeOperationTrait
{
    public function toPhpDatetime($code = null): string
    {
        $class = get_called_class();
        return constant($class. '::DATETIME_OPERATION');
    }
}