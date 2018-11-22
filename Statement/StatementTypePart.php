<?php

namespace Slov\Expression\Statement;

use MabeEnum\Enum;

/** Часть типа инструкции */
class StatementTypePart extends Enum
{
    const SIMPLE_STATEMENT = ';';

    const IF_STATEMENT = 'if(';

    const FOR_STATEMENT = 'for(';
}