<?php

namespace Slov\Expression\Operation;

/** Логическая операция ИЛИ */
class OrOperation extends BooleanOperation
{
    public function getSign(): string
    {
        return OperationSign::OR;
    }
}