<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePart;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\TypeNameAccessor;

/** Часть выражения */
abstract class ExpressionPart extends CodePart
{
    use TypeNameAccessor;

    /** Определение типа
     * @param CodeContext $codeContext контекст кода
     * @return TypeName тип
     * @throws CodeParseException */
    abstract protected function typeDefinition(CodeContext $codeContext): TypeName;
}