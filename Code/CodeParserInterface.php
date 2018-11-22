<?php

namespace Slov\Expression\Code;

/** Интерфейс разбора псевдо кода */
interface CodeParserInterface
{
    /** Разбор псевдо кода и сохранение его контексте
     * @param CodeContext $codeContext контекст кода
     * @return $this
     * @throws CodeParseException */
    public function parse(CodeContext $codeContext);
}