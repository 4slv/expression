<?php

namespace Slov\Expression\Statement;

use Slov\Expression\CodeAccessorTrait;
use Slov\Expression\Expression\TextExpression;
use Slov\Expression\ToPhpTransformer;

/** Инструкция */
abstract class Statement implements ToPhpTransformer
{
    use CodeAccessorTrait;

    /**
     * @return TextExpression выражение псевдо кода
     */
    protected function createTextExpression()
    {
        return new TextExpression();
    }
}