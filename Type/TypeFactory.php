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
     * @return BooleanType()
     */
    public function createBoolean()
    {
        return new BooleanType();
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
     * @return NullType
     */
    public function createNull()
    {
        return new NullType();
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
    public function createInterval()
    {
        return new DateIntervalType();
    }

    /**
     * @return ExpressionType
     */
    public function createExpression()
    {
        return new ExpressionType();
    }

    /**
     * @param TypeName $typeName название типа
     * @return Type
     */
    public function create(TypeName $typeName)
    {
        switch ($typeName->getValue())
        {
            case TypeName::BOOLEAN:
                return $this->createBoolean();
            case TypeName::INT:
                return $this->createInt();
            case TypeName::FLOAT:
                return $this->createFloat();
            case TypeName::NULL:
                return $this->createNull();
            case TypeName::MONEY:
                return $this->createMoney();
            case TypeName::DATE_TIME:
                return $this->createDateTime();
            case TypeName::DATE_INTERVAL:
                return $this->createInterval();
            case TypeName::EXPRESSION:
                return $this->createExpression();
        }
        return null;
    }
}