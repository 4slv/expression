<?php

namespace Slov\Expression\Statement;

use Slov\Expression\CodeAccessor;
use Slov\Expression\PhpTransformer;

/** Инструкция */
abstract class Statement implements PhpTransformer
{
    use CodeAccessor;
}