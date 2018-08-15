<?php

namespace Slov\Expression\Interfaces;

use Slov\Expression\Type\TypeName;

interface Operand
{

    /**
     * @return TypeName
     */
    public function getType();

}