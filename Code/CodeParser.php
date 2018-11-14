<?php

namespace Slov\Expression\Code;

/** Разбор кода */
interface CodeParser
{
    /** Разбор псевдо кода и сохранение его контексте
     * @param CodeContext $codeContext контекст кода
     * @return $this
     * @throws CodeParseException */
    public function parse(CodeContext $codeContext);
}