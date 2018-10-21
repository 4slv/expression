<?php

namespace Slov\Expression\Statement;

/** Простая инструкция */
class SimpleStatement extends Statement
{
    const REGEXP = '([^;]*);';

    public function toPhp($code, $codeContext): string
    {
        // TODO: Implement toPhp() method.
    }
}