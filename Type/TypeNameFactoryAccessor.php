<?php

namespace Slov\Expression\Type;


trait TypeNameFactoryAccessor
{
    /**
     * @return TypeNameFactory фабрика названий типов типов
     */
    protected function getTypeNameFactory()
    {
        return TypeNameFactory::getInstance();
    }
}