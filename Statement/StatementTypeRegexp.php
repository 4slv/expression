<?php

namespace Slov\Expression\Statement;


use MabeEnum\Enum;

/** Регулярное выражение для типа инструкции */
class StatementTypeRegexp extends Enum
{
    const SIMPLE_STATEMENT = '/[^;]+;/msi';

    const IF_STATEMENT = '/(if\([^\{\}]+\))\{.+\}/msi';

    const FOR_STATEMENT = '/(for\([^\{\}]+\))\{.+\}/msi';
}