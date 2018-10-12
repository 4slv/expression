<?php

namespace Slov\Expression\Operation;

use Slov\Expression\TextExpression\TextOperation;

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
     * @return GetFirstOperandOperation
     */
    public function createGetFirstOperandOperation()
    {
        return new GetFirstOperandOperation();
    }

    /**
     * @return DaysOperation
     */
    public function createDaysOperation()
    {
        return new DaysOperation();
    }

    /**
     * @return FirstYearDayOperation
     */
    public function createFirstYearDayOperation()
    {
        return new FirstYearDayOperation();
    }

    /**
     * @return IntOperation
     */
    public function createIntOperation()
    {
        return new IntOperation();
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
     * @return IfElseOperation
     */
    public function createIfElseOperation()
    {
        return new IfElseOperation();
    }

    /**
     * @return IfOperation
     */
    public function createIfOperation()
    {
        return new IfOperation();
    }

    /**
     * @return AssignOperation
     */
    public function createAssignOperation()
    {
        return new AssignOperation();
    }

    /**
     * @return MoneyOperation
     */
    public function createMoneyOperation()
    {
        return new MoneyOperation();
    }

    /**
     * @return ForOperation
     */
    public function createForOperation()
    {
        return new ForOperation();
    }

    /**
     * @param TextOperation $operationName
     * @return Operation
     */
    public function create(TextOperation $operationName)
    {
        switch($operationName->getOperationName()->getValue()){
            case OperationName::ADD:
                return $this->createAddOperation();
            case OperationName::SUBTRACTION:
                return $this->createSubtractionOperation();
            case OperationName::MULTIPLY:
                return $this->createMultiplyOperation();
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
            case OperationName::INT:
                return $this->createIntOperation();
            case OperationName::EQUAL:
                return $this->createEqualOperation();
            case OperationName::GREATER:
                return $this->createGreaterOperation();
            case OperationName::LESS:
                return $this->createLessOperation();
            case OperationName::GREATER_OR_EQUALS:
                return $this->createGreaterOrEqualOperation();
            case OperationName::LESS_OR_EQUALS:
                return $this->createLessOrEqualOperation();
            case OperationName::NOT:
                return $this->createNotOperation();
            case OperationName::AND:
                return $this->createAndOperation();
            case OperationName::OR:
                return $this->createOrOperation();
            case OperationName::IF_ELSE:
                return $this->createIfElseOperation();
            case OperationName::IF:
                return $this->createIfOperation();
            case OperationName::ASSIGN:
                return $this->createAssignOperation();
            case OperationName::MONEY:
                return $this->createMoneyOperation();
            case OperationName::FOR:
                return $this->createForOperation();
        }
        return null;
    }
}