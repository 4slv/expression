<?php

namespace Slov\Expression\Statement;

/** Простая инструкция */
class SimpleStatement extends Statement
{

    public function toPhp($code, $codeContext): string
    {
        $expressionPhp = $this
            ->createTextExpression()
            ->toPhp($expressionCode, $codeContext);
        return $expressionPhp. $match[2];
    }
}