<?php

namespace Slov\Expression\Operation;

use MabeEnum\Enum;

/** Знак операции */
class OperationSign extends Enum
{
    const EXPONENTIATION = '**';
    const ADD = '+';
    const MULTIPLY = '*';
    const SUBTRACTION = '-';
    const DIVISION = '/';
    const REMINDER_OF_DIVISION = '%';
    const EQUAL = '==';
    const GREATER = '>';
    const LESS = '<';
    const GREATER_OR_EQUAL = '>=';
    const LESS_OR_EQUAL = '<=';
    const NOT_EQUAL = '!=';
    const NOT = '!';
    const AND = '&&';
    const OR = '||';
}