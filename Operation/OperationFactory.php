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
     * @param OperationName $operationName
     * @return Operation
     */
    public function create(OperationName $operationName)
    {
        switch($operationName->getValue()){
            case OperationName::ADD:
                return $this->createAddOperation();
        }
        return null;
    }
}