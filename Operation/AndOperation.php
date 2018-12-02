<?php

namespace Slov\Expression\Operation;


/** Логическая операция И */
class AndOperation extends BooleanOperation
{
    public function getSign(): string
    {
        return OperationSign::AND;
    }
}