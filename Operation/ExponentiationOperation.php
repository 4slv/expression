<?php

namespace Slov\Expression\Operation;

/** Операция возведения в степень */
class ExponentiationOperation extends DigitOperation
{
    public function getSign(): string
    {
        return OperationSign::EXPONENTIATION;
    }
}