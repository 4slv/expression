<?php

namespace Slov\Expression\Operation;


use MabeEnum\Enum;

/** Тип операции */
class OperationType extends Enum
{
    const SIMPLE = 'simple';

    const COMPLEX = 'complex';
}