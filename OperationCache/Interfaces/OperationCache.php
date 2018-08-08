<?php

namespace Slov\Expression\OperationCache\Interfaces;

use Slov\Expression\Type\TypeName;

interface OperationCache
{
    /**
     * @return string
     */
    public function generatePhpCode();

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName();

}