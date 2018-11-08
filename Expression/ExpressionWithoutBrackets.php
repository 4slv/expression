<?php


namespace Slov\Expression\Expression;


use Slov\Expression\CodeAccessor;
use Slov\Expression\CodeContext;
use Slov\Expression\PhpTransformer;
use Slov\Expression\Type\TypeNameAccessor;

class ExpressionWithoutBrackets implements PhpTransformer
{
    use CodeAccessor;
    use TypeNameAccessor;

    public function toPhp(CodeContext $codeContext): string
    {
        // TODO: Implement toPhp() method.
    }
}