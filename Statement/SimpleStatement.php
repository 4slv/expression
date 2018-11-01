<?php

namespace Slov\Expression\Statement;

/** Простая инструкция */
class SimpleStatement extends Statement
{
    const REGEXP = '([^;]*)(;)';

    public function toPhp($code, $codeContext): string
    {
        preg_match(
            '/^'. self::REGEXP. '$/',
            $code,
            $match
        );
        $expressionCode = $match[1];
        $expressionPhp = $this
            ->createTextExpression()
            ->toPhp($expressionCode, $codeContext);
        return $expressionPhp. $match[2];
    }
}