<?php

namespace Slov\Expression\Functions;

use Slov\Expression\Code\CodeParseException;

/** Построитель списка функций */
class FunctionListBuilder
{
    /**
     * Инициализация функций
     * @throws CodeParseException
     */
    public function build(): void
    {
        FunctionList::emptyList();
        $this->buildInlineFunctions();
    }

    /**
     * Инициализация внутрених функций
     * @throws CodeParseException
     */
    protected function buildInlineFunctions(): void
    {
        foreach (get_class_methods(InlineFunctions::class) as $methodName)
        {
            FunctionList::append([InlineFunctions::class, $methodName], $methodName);
        }
    }

}