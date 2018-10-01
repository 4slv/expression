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

    /**
     * @return TypeName название типа деньги
     */
    public function createMoney()
    {
        return TypeName::byValue(TypeName::MONEY);
    }

    /**
     * @return TypeName название типа: дата и время
     */
    public function createDateTime()
    {
        return TypeName::byValue(TypeName::DATE_TIME);
    }

    /**
     * @return TypeName название типа: временной интервал
     */
    public function createDateInterval()
    {
        return TypeName::byValue(TypeName::DATE_INTERVAL);
    }

    /**
     * @return TypeName название типа: строка
     */
    public function createString()
    {
        return TypeName::byValue(TypeName::STRING);
    }

    /**
     * @return TypeName название типа: булев тип
     */
    public function createBoolean()
    {
        return TypeName::byValue(TypeName::BOOLEAN);
    }
}