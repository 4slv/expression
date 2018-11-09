<?php

namespace Slov\Expression\Code;

/** Преобразователь кода */
abstract class CodeConverter
{
    /** Разбор кода на части синтаксичесого дерева
     * @param string $code текст псевдо кода
     * @param CodeContext $context контекст кода
     * @return string метка корневого узла
     * @throws CodeParseException */
    abstract protected function parse(string $code, CodeContext $context): string;

    /** Преобразование псевдо кода в php-код
     * @param string $code псевдо код
     * @param CodeContext $context контекст кода
     * @return string php-код
     * @throws CodeParseException */
    public function toPhp(string $code, CodeContext $context): string
    {
        $codeTreeLabel = $this->parse($code, $context);
        $codeTree = $context->getCodeTree($codeTreeLabel);
        return $codeTree->toPhp($context);
    }
}