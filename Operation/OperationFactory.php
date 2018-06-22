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
     * @return ExponentiationOperation
     */
    public function createExponentiationOperation()
    {
        return new ExponentiationOperation();
    }

    /**
     * @return RemainderOfDivisionOperation
     */
    public function createRemainderOfDivisionOperation()
    {
        return new RemainderOfDivisionOperation();
    }

    /**
     * @return DateOperation
     */
    public function createDateOperation()
    {
        return new DateOperation();
    }

    /**
     * @return DaysInYearOperation
     */
    public function createDaysInYearOperation()
    {
        return new DaysInYearOperation();
    }

    /**
     * @return DaysOperation
     */
    public function createDaysOperation()
    {
        return new DaysOperation();
    }

    /**
     * @return FirstYearDayOperation()
     */
    public function createFirstYearDayOperation()
    {
        return new FirstYearDayOperation();
    }

    /**
     * @return FunctionOperation
     */
    public function createFunctionOperation()
    {
        return new FunctionOperation();
    }

    /**
     * @return IntOperation()
     */
    public function createIntOperation()
    {
        return new IntOperation();
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
            case OperationName::MULTIPLY:
                return $this->createMultiplyOperation();
            case OperationName::SUBTRACTION:
                return $this->createSubtractionOperation();
            case OperationName::DIVISION:
                return $this->createDivisionOperation();
            case OperationName::EXPONENTIATION:
                return $this->createExponentiationOperation();
            case OperationName::REMAINDER_OF_DIVISION:
                return $this->createRemainderOfDivisionOperation();
            case OperationName::DATE:
                return $this->createDateOperation();
            case OperationName::DAYS_IN_YEAR:
                return $this->createDaysInYearOperation();
            case OperationName::DAYS:
                return $this->createDaysOperation();
            case OperationName::FIRST_YEAR_DAY:
                return $this->createFirstYearDayOperation();
            case OperationName::FUNCTION:
                return $this->createFunctionOperation();
            case OperationName::INT:
                return $this->createIntOperation();
        }
        return null;
    }
}