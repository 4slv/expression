<?php

namespace Slov\Expression\Type;

use Slov\Expression\Code\CodeAccessor;
use Slov\Expression\Code\CodeToPhp;

/** Тип операнда */
abstract class Type implements CodeToPhp
{
    use CodeAccessor;
}