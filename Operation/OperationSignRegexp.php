<?php

namespace Slov\Expression\Operation;

use MabeEnum\Enum;
use Slov\Expression\Code\CodeParseException;

/** Регулярное выражение операции */
class OperationSignRegexp extends Enum
{
    const EXPONENTIATION = '\*\*';
    const ADD = '\+';
    const MULTIPLY = '\*';
    const SUBTRACTION = '\-';
    const DIVISION = '\/';
    const REMAINDER_OF_DIVISION = '\%';

    /** @param string $operationSign псевдо код знака операции
     * @return OperationName название операции
     * @throws CodeParseException */
    public static function getOperationName($operationSign)
    {
        foreach(self::getConstants() as $operationKey => $operationRegExp)
        {
            if(preg_match('/^'. $operationRegExp. '$/', $operationSign))
            {
                $operationName = constant(OperationName::class. '::'. $operationKey);
                return OperationName::byValue($operationName);
            }
        }
        throw new CodeParseException($operationSign. ' :: unknown operation');
    }
}