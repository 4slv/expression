<?php

namespace Slov\Expression\Operation;

use MyCLabs\Enum\Enum;

/** Знак операции */
class OperationSign extends Enum
{
    const EXPONENTIATION = '**';

    const ADD = '+';

    const MULTIPLY = '*';

    const SUBTRACTION = '-';

    const DIVISION = '/';

    const REMAINDER_OF_DIVISION = '%';

    const DATE = '{date}';

    const DAYS_IN_YEAR = '{days in year}';

    const DAYS = '{days}';

    const FIRST_YEAR_DAY = '{first year day}';

    const INT = '{int}';
}