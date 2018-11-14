<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodePart;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\TypeNameAccessor;

/** Часть выражения */
abstract class ExpressionPart extends CodePart
{
    use TypeNameAccessor;

    abstract protected function codeToTypeName(CodeContext $codeContext): TypeName;
}