<?php

namespace Slov\Expression\Type;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Expression\ExpressionPart;

/** Операнд */
class Operand extends ExpressionPart
{
    public function toPhp(CodeContext $codeContext): string
    {


    }

    public function parse(CodeContext $codeContext): void
    {
        $this->setTypeName(
            $this->codeToTypeName($codeContext)
        );
    }

    protected function codeToTypeName(CodeContext $codeContext): TypeName
    {
        return TypeRegExp::getTypeNameByStringValue($this->getCode());
    }


}