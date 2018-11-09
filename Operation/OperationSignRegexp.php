<?php

namespace Slov\Expression\Operation;

use MabeEnum\Enum;

/** Регулярное выражение операции */
class OperationSignRegexp extends Enum
{
    const ADD = '\+';
    const MULTIPLY = '\*';
    const SUBTRACTION = '\-';
    const DIVISION = '\/';
}