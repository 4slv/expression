<?php

namespace Slov\Expression\Statement;

use Slov\Expression\CodeAccessorTrait;
use Slov\Expression\ToPhpTransformer;

/** Инструкция */
abstract class Statement implements ToPhpTransformer
{
    use CodeAccessorTrait;
}