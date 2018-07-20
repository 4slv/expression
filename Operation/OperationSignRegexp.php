<?php

namespace Slov\Expression\Operation;

use MyCLabs\Enum\Enum;
use Slov\Expression\Type\TypeRegExp;

/** Регулярное выражение операции */
class OperationSignRegexp extends Enum
{
    const FOR = 'for\{([^;?}]+);([^;?}]+);([^;?}]+);([^}\?]+)}';

    const IF_ELSE = '\{([^\?\{\}]+)\?([^\:\{\}]+)(\:([^\{\}]+))?\}';

    const FUNCTION = '\$([a-zA-Z][\w\d]*)\[([^\[\]]+)?\]';

    const DATE = '\{date\}';

    const DAYS_IN_YEAR = '\{days in year\}';

    const DAYS = '\{days\}';

    const FIRST_YEAR_DAY = '\{first year day\}';

    const EQUAL = '\=\=';

    const GREATER_OR_EQUALS = '\>\=';

    const LESS_OR_EQUALS = '\<\=';

    const GREATER = '\>';

    const LESS = '\<';

    const EXPONENTIATION = '\*\*';

    const ADD = '\+';

    const MULTIPLY = '\*';

    const SUBTRACTION = '\-';

    const DIVISION = '\/';

    const REMAINDER_OF_DIVISION = '\%';

    const INT = '\{int\}';

    const NOT = '\!';

    const AND = '\&\&';

    const OR = '\|\|';

    const ASSIGN = '\$([a-zA-Z][\w\d]*)\s*\=(?!\=)';
}