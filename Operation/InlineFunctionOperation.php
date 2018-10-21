<?php

namespace Slov\Expression\Operation;


abstract class InlineFunctionOperation extends Operation
{
    public function getPhpTemplate(): string
    {
        return $this->getPhpTemplateInlineFunction();
    }

    public function toPhp($code, $codeContext): string
    {
        return $this->toPhpInlineFunction();
    }
}