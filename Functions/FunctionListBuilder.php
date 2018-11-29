<?php

namespace Slov\Expression\Functions;

use Slov\Expression\Type\TypeName;
use Slov\Expression\Code\CodeParseException;

/** Построитель списка функций */
class FunctionListBuilder
{
    public function build()
    {
        FunctionList::emptyList();
    }

    /**
     * Создание функций приведения типа
     * @throws CodeParseException
     */
    protected function createCastFunctions(): void
    {
        $castFunction = function($parameter){
            return $parameter;
        };

        foreach (TypeName::getValues() as $typeName)
        {
            FunctionList::append($castFunction, $typeName);
        }
    }

}