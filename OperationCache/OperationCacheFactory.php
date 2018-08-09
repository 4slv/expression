<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\OperationFactory;

class OperationCacheFactory extends OperationFactory
{

    /**
     * @return Add
     */
    public function createAddOperation()
    {
        return new Add();
    }

    /**
     * @return Subtraction
     */
    public function createSubtractionOperation()
    {
        return new Subtraction();
    }

    /**
     * @return Division
     */
    public function createDivisionOperation()
    {
        return new Division();
    }

    /**
     * @return  Multiply
     */
    public function createMultiplyOperation()
    {
        return new Multiply();
    }

    /**
     * @return Exponentiation
     */
    public function createExponentiationOperation()
    {
        return new Exponentiation();
    }

    /**
     * @return RemainderOfDivision
     */
    public function createRemainderOfDivisionOperation()
    {
        return new RemainderOfDivision();
    }

    /**
     * @return Date
     */
    public function createDateOperation()
    {
        return new Date();
    }

    /**
     * @return DaysInYear
     */
    public function createDaysInYearOperation()
    {
        return new DaysInYear();
    }

    /**
     * @return Days
     */
    public function createDaysOperation()
    {
        return new Days();
    }

    /**
     * @return FirstYearDay()
     */
    public function createFirstYearDayOperation()
    {
        return new FirstYearDay();
    }

    /**
     * @return UserFunction
     */
    public function createFunctionOperation()
    {
        return new UserFunction();
    }

    /**
     * @return IfElse()
     */
    public function createIfElseOperation()
    {
        return new IfElse();
    }

    /**
     * @return Equal
     */
    public function createEqualOperation()
    {
        return new Equal();
    }

    /**
     * @return Greater()
     */
    public function createGreaterOperation()
    {
        return new Greater();
    }

    /**
     * @return Less()
     */
    public function createLessOperation()
    {
        return new Less();
    }

    /**
     * @return GreaterOrEqual()
     */
    public function createGreaterOrEqualOperation()
    {
        return new GreaterOrEqual();
    }

    /**
     * @return LessOrEqual()
     */
    public function createLessOrEqualOperation()
    {
        return new LessOrEqual();
    }

    /**
     * @return Not()
     */
    public function createNotOperation()
    {
        return new Not();
    }

    /**
     * @return LogicalAnd()
     */
    public function createAndOperation()
    {
        return new LogicalAnd();
    }

    /**
     * @return LogicalOr()
     */
    public function createOrOperation()
    {
        return new LogicalOr();
    }

    /**
     * @return CastInt()
     */
    public function createIntOperation()
    {
        return new CastInt();
    }

    /**
     * @return Assign
     */
    public function createAssignOperation()
    {
        return new Assign();
    }

    /**
     * @return CycleFor
     */
    public function createForOperation()
    {
        return new CycleFor();
    }

    /**
     * @return Min
     */
    public function createMinOperation()
    {
        return new Min();
    }

    /**
     * @return Max
     */
    public function createMaxOperation()
    {
        return new Max();
    }


}