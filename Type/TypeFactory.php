<?php

namespace Slov\Expression\Type;

use Slov\Expression\Code\CodeParseException;

/** Фабрика типов */
class TypeFactory
{
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
     * @return FloatType
     */
    public function createFloat()
    {
        return new FloatType();
    }

    /**
     * @return BooleanType()
     */
    public function createBoolean()
    {
        return new BooleanType();
    }

    /**
     * @return MoneyType
     */
    public function createMoney()
    {
        return new MoneyType();
    }

    /**
     * @return DateTimeType
     */
    public function createDateTime()
    {
        return new DateTimeType();
    }

    /**
     * @return DateIntervalType
     */
    public function createDateInterval()
    {
        return new DateIntervalType();
    }

    /**
     * @return NullType
     */
    public function createNull()
    {
        return new NullType();
    }

    /**
     * @return StringType
     */
    public function createString()
    {
        return new StringType();
    }

    /**
     * @param TypeName $typeName название типа
     * @return Type тип
     * @throws CodeParseException
     */
    public function create(TypeName $typeName)
    {
        switch ($typeName->getValue())
        {
            case TypeName::INT:
                return $this->createInt();
            case TypeName::FLOAT:
                return $this->createFloat();
            case TypeName::BOOLEAN:
                return $this->createBoolean();
            case TypeName::MONEY:
                return $this->createMoney();
            case TypeName::DATE_TIME:
                return $this->createDateTime();
            case TypeName::DATE_INTERVAL:
                return $this->createDateInterval();
            case TypeName::NULL:
                return $this->createNull();
            case TypeName::STRING:
                return $this->createString();
            default:
                throw new CodeParseException($typeName->getValue(). ' :: type creation impossible');
        }
    }
}