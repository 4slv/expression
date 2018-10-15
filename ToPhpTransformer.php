<?php

namespace Slov\Expression;

/** Преобразователь сущности к php коду */
interface ToPhpTransformer
{

    /** Преобразование сущности в php код
     * @param string $code псевдо код
     * @return string php код */
    public function toPhp($code): string ;
}