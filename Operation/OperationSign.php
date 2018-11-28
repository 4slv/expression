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
}