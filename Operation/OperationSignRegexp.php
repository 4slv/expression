<?php

namespace Slov\Expression\Operation;

use MabeEnum\Enum;
use Slov\Expression\Expression\ExpressionException;

/** Регулярное выражение операции */
class OperationSignRegexp extends Enum
{
    const MIN = 'min\{([^}]+)\}';

    const MAX = 'max\{([^}]+)\}';

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

    const MONEY = '\{money\}';

    const NOT = '\!';

    const AND = '\&\&';

    const OR = '\|\|';

    const ASSIGN = '\$([a-zA-Z][\w\d]*)\s*\=(?!\=)';

    /**
     * @param string $operationStringValue строковое представление операции
     * @return OperationName название операции
     * @throws ExpressionException
     */
    public static function getOperationName($operationStringValue)
    {
        foreach(self::getConstants() as $operationKey => $operationRegExp)
        {
            if(preg_match('/^'. $operationRegExp. '$/', $operationStringValue))
            {
                $operationName = constant(OperationName::class. '::'. $operationKey);
                return OperationName::byValue($operationName);
            }
        }
        throw new ExpressionException('Unknown operation: "'. $operationStringValue. '"');
    }
}