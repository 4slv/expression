<?php

namespace Slov\Expression\Operation;

/** Фабрика операций */
class OperationFactory
{
    /**
     * @var OperationFactory
     */
    protected static $instance;

    protected function __construct(){}

    /**
     * @return OperationFactory
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return AddOperation
     */
    public function createAddOperation()
    {
        return new AddOperation();
    }

    /**
     * @return SubtractionOperation
     */
    public function createSubtractionOperation()
    {
        return new SubtractionOperation();
    }

    /**
     * @return DivisionOperation
     */
    public function createDivisionOperation()
    {
        return new DivisionOperation();
    }

    /**
     * @return  MultiplyOperation
     */
    public function createMultiplyOperation()
    {
        return new MultiplyOperation();
    }

    /**
     * @param OperationName $operationName
     * @return Operation
     */
    public function create(OperationName $operationName)
    {
        switch($operationName->getValue()){
            case OperationName::ADD:
                return $this->createAddOperation();
            case OperationName::SUBTRACTION:
                return $this->createSubtractionOperation();
            case OperationName::MULTIPLY:
                return $this->createMultiplyOperation();
            case OperationName::DIVISION:
                return $this->createDivisionOperation();
        }
        return null;
    }
}