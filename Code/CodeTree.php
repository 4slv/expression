<?php

namespace Slov\Expression\Code;

/** Код разобранный на дерево */
interface CodeTree
{
    /** Преобразование в php-код
     * @param CodeContext $context контекст кода
     * @return string php-код */
    public function toPhp(CodeContext $context): string;
}