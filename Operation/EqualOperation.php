<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Type\DateIntervalType;
use Slov\Money\Money;
use DateInterval;
use DateTime;

/** Операция сравнения */
class EqualOperation extends CompareOperation
{
    const MONEY_OPERATION = 'equal';

    const DATE_INTERVAL_OPERATION = 'equal';

}