<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Операция умножения */
class MultiplyOperation extends DigitOperation
{
    const OPERATION_SIGN = '*';

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        return parent::typeDefinition($codeContext);
    }

    public function toPhp(CodeContext $codeContext): string
    {
        return parent::toPhp($codeContext);
    }

    public function getSign(): string
    {
        return self::OPERATION_SIGN;
    }
}