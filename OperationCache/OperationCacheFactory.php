<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\OperationFactory;

class OperationCacheFactory extends OperationFactory
{

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
     * @return IfElseOperation()
     */
    public function createIfElseOperation()
    {
        return new IfElseOperation();
    }

    /**
     * @return EqualOperation
     */
    public function createEqualOperation()
    {
        return new EqualOperation();
    }

    /**
     * @return GreaterOperation()
     */
    public function createGreaterOperation()
    {
        return new GreaterOperation();
    }

    /**
     * @return LessOperation()
     */
    public function createLessOperation()
    {
        return new LessOperation();
    }

    /**
     * @return GreaterOrEqualOperation()
     */
    public function createGreaterOrEqualOperation()
    {
        return new GreaterOrEqualOperation();
    }

    /**
     * @return LessOrEqualOperation()
     */
    public function createLessOrEqualOperation()
    {
        return new LessOrEqualOperation();
    }

    /**
     * @return NotOperation()
     */
    public function createNotOperation()
    {
        return new NotOperation();
    }

    /**
     * @return AndOperation()
     */
    public function createAndOperation()
    {
        return new AndOperation();
    }

    /**
     * @return OrOperation()
     */
    public function createOrOperation()
    {
        return new OrOperation();
    }

    /**
     * @return IntOperation()
     */
    public function createIntOperation()
    {
        return new IntOperation();
    }

    /**
     * @return AssignOperation
     */
    public function createAssignOperation()
    {
        return new AssignOperation();
    }

    /**
     * @return ForOperation
     */
    public function createForOperation()
    {
        return new ForOperation();
    }

    /**
     * @return MinOperation
     */
    public function createMinOperation()
    {
        return new MinOperation();
    }

    /**
     * @return MaxOperation
     */
    public function createMaxOperation()
    {
        return new MaxOperation();
    }


}