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

    const EQUAL = '==';

    const GREATER_OR_EQUALS = '>=';

    const LESS_OR_EQUALS = '<=';

    const GREATER = '>';

    const LESS = '<';

    const NOT = '!';

    const AND = '&&';

    const OR = '||';

    const IF_ELSE = '?';
}