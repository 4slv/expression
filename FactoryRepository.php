<?php

namespace Slov\Expression;


use Slov\Expression\Operation\OperationFactory;
use Slov\Expression\Type\TypeFactory;
use Slov\Expression\Type\TypeNameFactory;

trait FactoryRepository
{
    /**
     * @return TypeFactory фабрика типов
     */
    public function getTypeFactory()
    {
        return TypeFactory::getInstance();
    }

    /**
     * @return OperationFactory фабрика операций
     */
    public function getOperationFactory()
    {
        return OperationFactory::getInstance();
    }

    /**
     * @return TypeNameFactory фабрика названий типов
     */
    public function getTypeNameFactory()
    {
        return TypeNameFactory::getInstance();
    }
}