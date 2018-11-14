<?php

namespace Slov\Expression\Code;

/** Преобразователь псевдо кода в php-код */
interface CodeToPhp
{
    /** преобразование псевдо кода в php-код
     * @param CodeContext $codeContext контекст кода
     * @return string php-код
     * @throws CodeParseException */
    public function toPhp(CodeContext $codeContext): string;
}