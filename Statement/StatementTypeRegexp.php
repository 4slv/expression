<?php

namespace Slov\Expression\Statement;


use MabeEnum\Enum;

/** Регулярное выражение для типа инструкции */
class StatementTypeRegexp extends Enum
{
    const SIMPLE_STATEMENT = '/[^;]+;/';

    const IF_STATEMENT = '/(if\([^\{\}]+\))\{.+\}/';

    const FOR_STATEMENT = '/(for\([^\{\}]+\))\{.+\}/';
}