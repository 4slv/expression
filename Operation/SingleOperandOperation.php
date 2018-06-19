<?php

namespace Slov\Expression\Operation;

use Slov\Expression\FactoryRepository;
use Slov\Expression\Type\NullType;

trait SingleOperandOperation
{
    use FactoryRepository;

    /**
     * @return NullType нет значения
     */
    protected function createZero()
    {
        return $this->getTypeFactory()->createNull();
    }

}