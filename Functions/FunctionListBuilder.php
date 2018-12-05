<?php

namespace Slov\Expression\Functions;

use Slov\Expression\Code\CodeParseException;

/** Построитель списка функций */
class FunctionListBuilder
{
    use UserFunctionListAccessor;

    /**
     * Инициализация функций
     * @throws CodeParseException
     */
    public function build(): void
    {
        StaticFunctionList::emptyList();
        $this->buildInlineFunctions();
        $this->buildUserFunctions();
    }

    /**
     * Инициализация внутрених функций
     * @throws CodeParseException
     */
    protected function buildInlineFunctions(): void
    {
        foreach (get_class_methods(InlineFunctions::class) as $methodName)
        {
            StaticFunctionList::append([InlineFunctions::class, $methodName], $methodName);
        }
    }

    /**
     * Инициащизация пользовательских функций
     * @throws CodeParseException
     */
    protected function buildUserFunctions(): void
    {
        foreach ($this->getUserFunctionList()->getList() as $functionName => $function){
            StaticFunctionList::append($function, $functionName);
        }
    }

}