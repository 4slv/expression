<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeParseException;

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
     * @return  RemainderOfDivisionOperation
     */
    public function createRemainderOfDivisionOperation()
    {
        return new RemainderOfDivisionOperation();
    }

    /**
     * @return ExponentiationOperation
     */
    public function createExponentiationOperation()
    {
        return new ExponentiationOperation();
    }

    /**
     * @return EqualOperation
     */
    public function createEqualOperation()
    {
        return new EqualOperation();
    }

    /**
     * @return GreaterOperation
     */
    public function createGreaterOperation()
    {
        return new GreaterOperation();
    }

    /**
     * @return LessOperation
     */
    public function createLessOperation()
    {
        return new LessOperation();
    }

    /**
     * @return GreaterOrEqualOperation
     */
    public function createGreaterOrEqualOperation()
    {
        return new GreaterOrEqualOperation();
    }

    /**
     * @return LessOrEqualOperation
     */
    public function createLessOrEqualOperation()
    {
        return new LessOrEqualOperation();
    }

    /**
     * @return NotEqualOperation
     */
    public function createNotEqualOperation()
    {
        return new NotEqualOperation();
    }

    /**
     * @return NotOperation
     */
    public function createNotOperation()
    {
        return new NotOperation();
    }

    /**
     * @return AndOperation
     */
    public function createAndOperation()
    {
        return new AndOperation();
    }

    /**
     * @return OrOperation
     */
    public function createOrOperation()
    {
        return new OrOperation();
    }

    /**
     * @return IfElseOperation()
     */
    public function createIfElseOperation()
    {
        return new IfElseOperation();
    }

    /**
     * @param OperationName $operationName название операции
     * @return Operation операция
     * @throws CodeParseException
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
            case OperationName::REMAINDER_OF_DIVISION:
                return $this->createRemainderOfDivisionOperation();
            case OperationName::EXPONENTIATION:
                return $this->createExponentiationOperation();
            case OperationName::EQUAL:
                return $this->createEqualOperation();
            case OperationName::GREATER:
                return $this->createGreaterOperation();
            case OperationName::LESS:
                return $this->createLessOperation();
            case OperationName::GREATER_OR_EQUAL:
                return $this->createGreaterOrEqualOperation();
            case OperationName::LESS_OR_EQUAL:
                return $this->createLessOrEqualOperation();
            case OperationName::NOT_EQUAL:
                return $this->createNotEqualOperation();
            case OperationName::NOT:
                return $this->createNotOperation();
            case OperationName::AND:
                return $this->createAndOperation();
            case OperationName::OR:
                return $this->createOrOperation();
            case OperationName::IF_ELSE:
                return $this->createIfElseOperation();
            default:
                throw new CodeParseException($operationName->getValue(). ' :: operation creation impossible');
        }
    }
}