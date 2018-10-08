<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\DateIntervalType;
use Slov\Money\Money;
use DateInterval;
use DateTime;

/** Операция сравнения 'больше' */
class GreaterOperation extends CompareOperation
{
    const MONEY_OPERATION = 'more';

    const DATE_INTERVAL_OPERATION = 'greater';
}