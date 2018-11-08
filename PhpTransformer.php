<?php

namespace Slov\Expression;

/** Преобразователь сущности к php коду */
interface PhpTransformer
{

    /** Преобразование сущности в php код
     * @param CodeContext $codeContext контекст кода
     * @return string php код */
    public function toPhp(CodeContext $codeContext): string ;
}