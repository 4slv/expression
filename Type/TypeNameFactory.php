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
        return new TypeName(TypeName::INT);
    }

    /**
     * @return TypeName название типа числа с плавающей запятой
     */
    public function createFloat()
    {
        return new TypeName(TypeName::FLOAT);
    }

    /**
     * @return TypeName название типа деньги
     */
    public function createMoney()
    {
        return new TypeName(TypeName::MONEY);
    }

    /**
     * @return TypeName название типа: дата и время
     */
    public function createDateTime()
    {
        return new TypeName(TypeName::DATE_TIME);
    }

    /**
     * @return TypeName название типа: временной интервал
     */
    public function createDateInterval()
    {
        return new TypeName(TypeName::DATE_INTERVAL);
    }

    /**
     * @return TypeName название типа: булев тип
     */
    public function createBoolean()
    {
        return new TypeName(TypeName::BOOLEAN);
    }
}