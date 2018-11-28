<?php

namespace Slov\Expression\Operation;


class ExponentiationOperation extends DigitOperation
{
    public function getSign(): string
    {
        return OperationSign::EXPONENTIATION;
    }
}