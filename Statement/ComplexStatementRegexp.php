<?php

namespace Slov\Expression\Statement;


use MabeEnum\Enum;

/** Регулярное выражение составной инструкции */
class ComplexStatementRegexp extends Enum
{
    const FOR = 'for\{([^;?}]+);([^;?}]+);([^;?}]+);([^}\?]+)\}';

    const IF = '\{([^\?\{\}]+)\?([^\:\{\}]+)}';
}