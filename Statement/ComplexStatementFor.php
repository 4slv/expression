<?php

namespace Slov\Expression\Statement;

/** Комплексная инструкция for */
class ComplexStatementFor extends ComplexStatement
{
    public function toPhp($code, $codeContext): string
    {
        return $code;
    }

    public function parseParts()
    {
        // TODO: Implement parseParts() method.
    }
}