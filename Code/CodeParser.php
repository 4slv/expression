<?php

namespace Slov\Expression\Code;

/** Разбор кода */
interface CodeParser
{
    /** Разбор псевдо кода и сохранение его контексте
     * @param CodeContext $codeContext контекст кода */
    public function parse(CodeContext $codeContext): void;
}