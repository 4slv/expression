<?php

namespace Slov\Expression\Type;

/** Фабрика названий типов */
class TypeNameFactory
{
    /**
     * @var TypeNameFactory
     */
    protected static $instance;

    protected function __construct(){}

    /**
     * @return TypeNameFactory
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return TypeName название типа целого числа
     */
    public function createInt()
    {
        return TypeName::byValue(TypeName::INT);
    }

    /**
     * @return TypeName название типа числа с плавающей запятой
     */
    public function createFloat()
    {
        return TypeName::byValue(TypeName::FLOAT);
    }
}