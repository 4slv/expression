<?php

namespace Slov\Expression\Type;


/** Фабрика типов */
class TypeFactory {

    /**
     * @var TypeFactory
     */
    protected static $instance;

    protected function __construct(){}

    /**
     * @return TypeFactory
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return IntType
     */
    public function createInt()
    {
        return new IntType();
    }


    /**
     * @param TypeName $typeName название типа
     * @return Type
     */
    public function create(TypeName $typeName)
    {
        switch ($typeName->getValue())
        {
            case TypeName::INT:
                return $this->createInt();
        }
        return null;
    }
}