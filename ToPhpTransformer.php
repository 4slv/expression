<?php

namespace Slov\Expression;

/** Преобразователь сущности к php коду */
interface ToPhpTransformer
{

    /** Преобразование сущности в php код
     * @param string $code псевдо код
     * @param CodeContext $codeContext контекст кода
     * @return string php код */
    public function toPhp(string $code, CodeContext $codeContext): string ;
}