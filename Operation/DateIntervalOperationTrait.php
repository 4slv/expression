<?php

namespace Slov\Expression\Operation;

/** Операция с временным интервалом */
trait DateIntervalOperationTrait
{
    public function toPhpDateInterval($code = null): string
    {
        $class = get_called_class();
        return constant($class. '::DATE_INTERVAL_OPERATION');
    }
}